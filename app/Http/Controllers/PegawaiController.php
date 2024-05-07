<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    function index()
    {
        return view('Pegawai.dashboardPegawai');
        // echo "<a href='logout'> Logout >> </a>";
    }
    function admin()
    {
        $user = User::where('role', 'pegawai')->get();
        // dd($user);
        return view('dashboardAdmin');
        // echo "<a href='logout'> Logout >> </a>";
    }
    function kasubag()
    {
        return view('kasubag.dashboardKasubag');
        // echo "<a href='logout'> Logout >> </a>";
    }
}
