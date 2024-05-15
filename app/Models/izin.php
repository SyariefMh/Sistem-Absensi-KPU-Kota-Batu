<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'kode_absen',
        'tanggal_awal',
        'tanggal_akhir',
        'jam_datang',
        'jam_pulang',
        'keterangan',
        'file',
        'user_id',
        'periode_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function periode()
    {
        return $this->belongsTo(periode::class);
    }
}
