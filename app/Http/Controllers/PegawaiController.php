<?php

namespace App\Http\Controllers;

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
        return view('dashboardAdmin');
        // echo "<a href='logout'> Logout >> </a>";
    }
    function kasubag()
    {
        return view('dashboardKasubag');
        // echo "<a href='logout'> Logout >> </a>";
    }
}
