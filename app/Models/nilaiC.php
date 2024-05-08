<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilaiC extends Model
{
    use HasFactory;

    protected $table = 'nilai_c';

    protected $fillable = [
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
