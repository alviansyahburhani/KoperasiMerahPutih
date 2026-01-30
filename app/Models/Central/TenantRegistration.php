<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class TenantRegistration extends Model
{
    protected $fillable = [
        'nama_koperasi',
        'subdomain',
        'email',
        'phone',
        'alamat',
        'pic_name',
        'pic_position',
        'pic_phone',
        'pic_email',
        'dokumen_pengesahan',
        'dokumen_daftar_umum',
        'dokumen_akte_notaris',
        'dokumen_npwp',
        'package_id',
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by',
        'tenant_id',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($registration) {
            if (empty($registration->subdomain)) {
                $registration->subdomain = Str::slug($registration->nama_koperasi);
            }
        });
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}