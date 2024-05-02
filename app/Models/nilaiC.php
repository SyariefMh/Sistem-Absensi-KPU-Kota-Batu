<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilaiC extends Model
{
    use HasFactory;

    protected $table = 'nilai_c';

    protected $fillable = [
        'kriteria1',
        'kriteria2',
        'kriteria3',
        'kriteria4',
        'nilai1',
        'nilai2',
        'nilai3',
        'nilai4',
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
