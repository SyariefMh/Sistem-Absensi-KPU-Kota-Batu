<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datangQrCode extends Model
{
    use HasFactory;

    protected $table = 'datangqrcode';

    protected $fillable = [
        'tanggal',
        'kode_absen',
        'jam_datang',
        'jam_pulang',
        'Keterangan',
        'Status',
        'qrcode_id',
        'user_id',
        'periode_id',
    ];

    public function qrcodeGen()
    {
        return $this->belongsTo(QrcodeGen::class, 'qrcode_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function periode()
    {
        return $this->belongsTo(periode::class);
    }
}
