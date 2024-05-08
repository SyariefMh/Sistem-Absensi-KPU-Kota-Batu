<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilaiA extends Model
{
    use HasFactory;

    protected $table = 'nilai_a';

    protected $fillable = [
        'kriteria1_A',
        'kriteria2_A',
        'kriteria3_A',
        'kriteria4_A',
        'nilai1_A',
        'nilai2_A',
        'nilai3_A',
        'nilai4_A',
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
        'kriteria1_C',
        'kriteria2_C',
        'kriteria3_C',
        'kriteria4_C',
        'kriteria5_C',
        'nilai1_C',
        'nilai2_C',
        'nilai3_C',
        'nilai4_C',
        'nilai5_C',
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
