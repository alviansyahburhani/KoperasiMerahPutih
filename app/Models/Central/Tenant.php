<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'id',
        'nama_koperasi',
        'subdomain',
        'email',
        'phone',
        'alamat',
        'dokumen_pengesahan',
        'dokumen_daftar_umum',
        'dokumen_akte_notaris',
        'dokumen_npwp',
        'status',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'nama_koperasi',
            'subdomain',
            'email',
            'phone',
            'alamat',
            'dokumen_pengesahan',
            'dokumen_daftar_umum',
            'dokumen_akte_notaris',
            'dokumen_npwp',
            'status',
            'approved_at',
            'approved_by',
        ];
    }

    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class);
    }

    protected static function booted()
    {
        static::creating(function ($tenant) {
            if (empty($tenant->id)) {
                $tenant->id = (string) \Illuminate\Support\Str::uuid();
            }
        });

        static::created(function ($tenant) {
            $tenant->domains()->create([
                'domain' => $tenant->subdomain . '.localhost',
            ]);
        });
    }
}