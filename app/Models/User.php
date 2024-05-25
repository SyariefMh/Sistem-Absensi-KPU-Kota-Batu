<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'role',
        'jabatan',
        'nip',
        'pangkat',
        'golongan',
        'tandatanggan'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    // Relationships
    public function datangqrcode()
    {
        return $this->hasMany(DatangQrCode::class)->onDelete('cascade');
    }

    public function izins()
    {
        return $this->hasMany(Izin::class)->onDelete('cascade');
    }

    public function cutis()
    {
        return $this->hasMany(cuti::class)->onDelete('cascade');
    }

    public function dinlurs()
    {
        return $this->hasMany(Dinlur::class)->onDelete('cascade');
    }

    public function qrcodeGens()
    {
        return $this->hasMany(QrCodeGen::class)->onDelete('cascade');
    }
}
