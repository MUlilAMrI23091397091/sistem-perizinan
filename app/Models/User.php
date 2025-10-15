<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $role
 * @property string|null $jenis_pelaku_usaha
 * @property string|null $jenis_badan_usaha
 * @property string|null $nama_usaha
 * @property string|null $nik
 * @property string|null $npwp
 * @property string|null $alamat
 * @property string|null $no_telepon
 * @property string|null $sektor
 * @property string|null $jenis_proyek
 * @property string|null $verifikator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permohonan> $permohonans
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'jenis_pelaku_usaha',
        'jenis_badan_usaha',
        'nama_usaha',
        'nik',
        'npwp',
        'alamat',
        'no_telepon',
        'sektor',
        'jenis_proyek',
        'verifikator',
    ];

    /**
     * The attributes that should be validated.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->name)) {
                throw new \InvalidArgumentException('Name is required');
            }
            if (empty($user->email) || !filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                throw new \InvalidArgumentException('Valid email is required');
            }
            if (empty($user->password) || strlen($user->password) < 8) {
                throw new \InvalidArgumentException('Password must be at least 8 characters');
            }
            if (!in_array($user->role, ['admin', 'dpmptsp', 'pd_teknis', 'penerbitan_berkas'])) {
                throw new \InvalidArgumentException('Invalid role');
            }
        });

        static::updating(function ($user) {
            if (!empty($user->email) && !filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                throw new \InvalidArgumentException('Valid email is required');
            }
            if (!empty($user->password) && strlen($user->password) < 8) {
                throw new \InvalidArgumentException('Password must be at least 8 characters');
            }
            if (!empty($user->role) && !in_array($user->role, ['admin', 'dpmptsp', 'pd_teknis', 'penerbitan_berkas'])) {
                throw new \InvalidArgumentException('Invalid role');
            }
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke Permohonan (1 User bisa punya banyak Permohonan)
     */
    public function permohonans(): HasMany
    {
        return $this->hasMany(Permohonan::class);
    }
}
