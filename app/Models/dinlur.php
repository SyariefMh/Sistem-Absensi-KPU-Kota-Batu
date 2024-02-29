<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dinlur extends Model
{
    use HasFactory;
    protected $table = 'dinlurs'; // Specify the table name
    protected $fillable = [
        'tanggal',
        'jam_datang',
        'jam_pulang',
        'Keterangan',
        'longitude',
        'latitude',
        'file',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
