<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class nilaiController extends Controller
{
    public function nilai($id){
        $nilai=User::find($id);
        return view('kasubag.penilaianPegawai',compact('nilai'));
    }
}
