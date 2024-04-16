<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periode extends Model
{
    use HasFactory;

    protected $table = 'periode';
    protected $fillable = [
        'periode_bulan',
        'periode_tahun',
        'nama_jabatan',
        'nip_nama_jabatan',
        'status',
    ];
}
