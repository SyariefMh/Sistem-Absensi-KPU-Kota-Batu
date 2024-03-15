<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pulangQrCode extends Model
{
    use HasFactory;

    protected $table = 'pulangqrcode';

    protected $fillable = [
        'tanggal',
        'jam_datang',
        'jam_pulang',
        'Keterangan',
        'qrcode_id',
        'Status',
        'user_id',
    ];

    public function qrcode()
    {
        return $this->belongsTo(QrcodeGen::class, 'qrcode_id');
    }
}
