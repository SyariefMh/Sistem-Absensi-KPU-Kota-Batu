<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilaiB extends Model
{
    use HasFactory;

    protected $table = 'nilai_b';

    protected $fillable = [
        'kriteria1_B',
        'kriteria2_B',
        'kriteria3_B',
        'kriteria4_B',
        'kriteria5_B',
        'nilai1_B',
        'nilai2_B',
        'nilai3_B',
        'nilai4_B',
        'nilai5_B',
        'user_id',
        'periode_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
