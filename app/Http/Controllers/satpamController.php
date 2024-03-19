<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class satpamController extends Controller
{
    function index()
    {
        return view('Satpam.dashboardSatpam');
        // echo "<a href='logout'> Logout >> </a>";
    }
}
