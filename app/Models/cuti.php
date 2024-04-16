<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'tanggal_awal',
        'tanggal_akhir',
        'jam_datang',
        'jam_pulang',
        'Keterangan',
        'file',
        'user_id',
        'periode_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function periode()
    {
        return $this->belongsTo(periode::class);
    }
}
