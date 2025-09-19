<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_permohonan',
        'nama_usaha',
        'jenis_perusahaan', 
        'jenis_pelaku_usaha',
        'jenis_badan_usaha',
        'nik',
        'tanggal_permohonan',
        'nib',
        'alamat_perusahaan',
        'sektor',
        'modal_usaha',
        'jenis_proyek',
        'no_proyek',
        'verifikator',
        'verifikasi_dpmptsp',
        'verifikasi_pd_teknis',
        'status',
        'pengembalian',
        'keterangan_pengembalian',
        'menghubungi',
        'keterangan_menghubungi',
        'status_menghubungi',
        'perbaikan',
        'keterangan_perbaikan',
        'terbit',
        'keterangan_terbit',
        'pemroses_dan_tgl_surat',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_permohonan' => 'date',
        'pengembalian' => 'date',
        'menghubungi' => 'date',
        'perbaikan' => 'date',
        'terbit' => 'date',
        // Tambahkan juga untuk created_at dan updated_at jika ingin eksplisit meskipun sudah default
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Jika kamu memiliki `$dates` sebelumnya, sebaiknya pindahkan semua ke `$casts`
    // atau hapus `$dates` untuk menghindari kebingungan.
    // protected $dates = [
    //     'tanggal_permohonan',
    //     'pengembalian',
    //     'menghubungi',
    //     'perbaikan',
    //     'terbit'
    // ];
    // Saya telah menonaktifkan `$dates` di sini, pastikan kamu juga menghapusnya di file kamu.
    
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke LogPermohonan
    public function logs()
    {
        return $this->hasMany(LogPermohonan::class);
    }
}