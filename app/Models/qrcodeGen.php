<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrcodeGen extends Model
{
    use HasFactory;

    protected $fillable = [
        'qrcode_datang',
        'qrcode_pulang',
        'qrcodefilesDtg',
        'qrcodefilesPlg',
        'tanggal',
        'status',
        'tanggal_kirimDtg',
        'tanggal_kirimPlg',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
