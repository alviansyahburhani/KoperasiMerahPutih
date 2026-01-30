<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->rememberToken();
            $table->timestamps();
        });

        // Password reset tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions table (for session-based auth)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // 1. Anggota
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('no_anggota')->unique();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->enum('status_perkawinan', ['belum_kawin', 'kawin', 'cerai'])->nullable();
            $table->date('tanggal_masuk')->default(now());
            $table->decimal('simpanan_pokok', 15, 2)->default(0);
            $table->decimal('simpanan_wajib', 15, 2)->default(0);
            $table->enum('status', ['aktif', 'non_aktif', 'keluar'])->default('aktif');
            $table->string('foto')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 2. Pengurus
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('jabatan', ['ketua', 'sekretaris', 'bendahara']);
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->string('sk_pengangkatan')->nullable();
            $table->enum('status', ['aktif', 'non_aktif'])->default('aktif');
            $table->timestamps();
        });

        // 3. Pengawas
        Schema::create('pengawas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('jabatan');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->string('sk_pengangkatan')->nullable();
            $table->enum('status', ['aktif', 'non_aktif'])->default('aktif');
            $table->timestamps();
        });

        // 4. Simpanan
        Schema::create('simpanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota')->cascadeOnDelete();
            $table->enum('jenis', ['pokok', 'wajib', 'sukarela']);
            $table->date('tanggal');
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });

        // 5. Pinjaman
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota')->cascadeOnDelete();
            $table->date('tanggal_pengajuan');
            $table->decimal('jumlah_pinjaman', 15, 2);
            $table->integer('jangka_waktu');
            $table->decimal('bunga_persen', 5, 2);
            $table->text('tujuan_pinjaman')->nullable();
            $table->date('tanggal_disetujui')->nullable();
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected', 'lunas'])->default('pending');
            $table->string('file_pengajuan')->nullable();
            $table->timestamps();
        });

        // 6. Angsuran
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained('pinjaman')->cascadeOnDelete();
            $table->integer('angsuran_ke');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->decimal('jumlah_pokok', 15, 2);
            $table->decimal('jumlah_bunga', 15, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('denda', 15, 2)->default(0);
            $table->enum('status', ['belum', 'lunas', 'terlambat'])->default('belum');
            $table->timestamps();
        });

        // 7. Inventaris
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kategori')->nullable();
            $table->integer('jumlah')->default(1);
            $table->string('satuan')->nullable();
            $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            $table->date('tanggal_beli')->nullable();
            $table->decimal('harga_beli', 15, 2)->nullable();
            $table->string('lokasi')->nullable();
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 8. Notulen Rapat Anggota
        Schema::create('notulen_rapat_anggota', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_rapat');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai')->nullable();
            $table->string('tempat');
            $table->string('jenis_rapat');
            $table->integer('jumlah_peserta')->default(0);
            $table->text('agenda');
            $table->longText('pembahasan')->nullable();
            $table->longText('keputusan')->nullable();
            $table->string('file_notulen')->nullable();
            $table->string('file_absensi')->nullable();
            $table->string('file_dokumentasi')->nullable();
            $table->foreignId('notulis')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('disahkan_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 9. Notulen Rapat Pengurus
        Schema::create('notulen_rapat_pengurus', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_rapat');
            $table->text('agenda');
            $table->longText('pembahasan')->nullable();
            $table->longText('keputusan')->nullable();
            $table->json('peserta')->nullable();
            $table->foreignId('notulis')->nullable()->constrained('users')->nullOnDelete();
            $table->string('file_notulen')->nullable();
            $table->timestamps();
        });

        // 10. Notulen Rapat Pengawas
        Schema::create('notulen_rapat_pengawas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_rapat');
            $table->text('agenda');
            $table->longText('pembahasan')->nullable();
            $table->longText('keputusan')->nullable();
            $table->json('peserta')->nullable();
            $table->foreignId('notulis')->nullable()->constrained('users')->nullOnDelete();
            $table->string('file_notulen')->nullable();
            $table->timestamps();
        });

        // 11. Karyawan
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('jabatan');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->decimal('gaji', 15, 2)->nullable();
            $table->enum('status', ['aktif', 'non_aktif'])->default('aktif');
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        // 12. Buku Tamu
        Schema::create('buku_tamu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('instansi')->nullable();
            $table->text('alamat')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('keperluan');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan')->nullable();
            $table->foreignId('dilayani_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['menunggu', 'selesai'])->default('menunggu');
            $table->timestamps();
        });

        // 13. Saran Anggota
        Schema::create('saran_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->nullOnDelete();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->enum('kategori', ['keluhan', 'saran', 'pertanyaan']);
            $table->string('judul');
            $table->longText('isi');
            $table->string('file_pendukung')->nullable();
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->longText('tanggapan')->nullable();
            $table->foreignId('ditanggapi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('tanggal_tanggapan')->nullable();
            $table->timestamps();
        });

        // 14. Saran Pengawas
        Schema::create('saran_pengawas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengawas_id')->nullable()->constrained('pengawas')->nullOnDelete();
            $table->enum('kategori', ['audit', 'rekomendasi', 'temuan']);
            $table->string('judul');
            $table->longText('isi');
            $table->string('file_pendukung')->nullable();
            $table->enum('status', ['baru', 'ditindaklanjuti', 'selesai'])->default('baru');
            $table->longText('tanggapan')->nullable();
            $table->foreignId('ditanggapi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('tanggal_tanggapan')->nullable();
            $table->timestamps();
        });

        // 15. Anjuran Pejabat
        Schema::create('anjuran_pejabat', function (Blueprint $table) {
            $table->id();
            $table->string('dari_instansi');
            $table->string('perihal');
            $table->date('tanggal_surat');
            $table->string('nomor_surat')->nullable();
            $table->longText('isi');
            $table->string('file_surat')->nullable();
            $table->enum('status', ['baru', 'ditindaklanjuti', 'selesai'])->default('baru');
            $table->longText('tindak_lanjut')->nullable();
            $table->foreignId('ditindaklanjuti_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 16. Catatan Kejadian
        Schema::create('catatan_kejadian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kejadian');
            $table->time('jam_kejadian')->nullable();
            $table->enum('kategori', ['insiden', 'pencapaian', 'lainnya']);
            $table->string('judul');
            $table->longText('kronologi');
            $table->text('dampak')->nullable();
            $table->text('tindakan')->nullable();
            $table->foreignId('pelapor')->nullable()->constrained('users')->nullOnDelete();
            $table->string('file_pendukung')->nullable();
            $table->timestamps();
        });

        // 17. Agenda & Ekspedisi
        Schema::create('agenda_ekspedisi', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['surat_masuk', 'surat_keluar', 'agenda']);
            $table->date('tanggal');
            $table->string('nomor_surat')->nullable();
            $table->string('dari')->nullable();
            $table->string('kepada')->nullable();
            $table->string('perihal');
            $table->text('keterangan')->nullable();
            $table->string('file_surat')->nullable();
            $table->enum('status', ['belum_diproses', 'diproses', 'selesai'])->default('belum_diproses');
            $table->timestamps();
        });

        // Landing Page Tables
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->longText('about_content')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('contact_address')->nullable();
            $table->text('maps_embed')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('kategori')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 15, 2)->nullable();
            $table->integer('stok')->default(0);
            $table->string('kategori')->nullable();
            $table->json('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('kategori')->nullable();
            $table->date('tanggal_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('products');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('landing_pages');
        Schema::dropIfExists('agenda_ekspedisi');
        Schema::dropIfExists('catatan_kejadian');
        Schema::dropIfExists('anjuran_pejabat');
        Schema::dropIfExists('saran_pengawas');
        Schema::dropIfExists('saran_anggota');
        Schema::dropIfExists('buku_tamu');
        Schema::dropIfExists('karyawan');
        Schema::dropIfExists('notulen_rapat_pengawas');
        Schema::dropIfExists('notulen_rapat_pengurus');
        Schema::dropIfExists('notulen_rapat_anggota');
        Schema::dropIfExists('inventaris');
        Schema::dropIfExists('angsuran');
        Schema::dropIfExists('pinjaman');
        Schema::dropIfExists('simpanan');
        Schema::dropIfExists('pengawas');
        Schema::dropIfExists('pengurus');
        Schema::dropIfExists('anggota');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};