<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenerbitanBerkas extends Model
{
    use HasFactory;

    protected $table = 'penerbitan_berkas';

    protected $fillable = [
        'user_id',
        'no_permohonan',
        'no_proyek',
        'tanggal_permohonan',
        'nib',
        'kbli',
        'nama_usaha',
        'inputan_teks',
        'jenis_pelaku_usaha',
        'jenis_badan_usaha',
        'pemilik',
        'modal_usaha',
        'alamat_perusahaan',
        'jenis_proyek',
        'nama_perizinan',
        'skala_usaha',
        'risiko',
        'status',
    ];

    protected $casts = [
        'tanggal_permohonan' => 'date',
        'modal_usaha' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


