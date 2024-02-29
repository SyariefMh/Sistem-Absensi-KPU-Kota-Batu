<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\dinlur;
use App\Models\izin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class riwayatabsenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id; // Retrieve the user ID

        $cuti = Cuti::where('user_id', $userId)
            ->select(['id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan']); // Retrieve records from Cuti model
        $izins = Izin::where('user_id', $userId)
            ->select(['id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan']); // Retrieve records from Izin model
        $dinlur = dinlur::where('user_id', $userId)
            ->select(['id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan']); // Retrieve records from Izin model

        $combinedData = $cuti->union($izins)->union($dinlur)->get();

        return view('riwayatAbsen', compact('combinedData'));
    }
}
