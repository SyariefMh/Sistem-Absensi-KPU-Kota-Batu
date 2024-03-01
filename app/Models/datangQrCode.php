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
        'jam_datang',
        'jam_pulang',
        'Keterangan',
        'qrcode_id',
    ];

    public function qrcodeGen()
    {
        return $this->belongsTo(QrcodeGen::class, 'qrcode_id');
    }
}
