<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'tanggal_awal',
        'tanggal_akhir',
        'jam_datang',
        'jam_pulang',
        'keterangan',
        'file',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
