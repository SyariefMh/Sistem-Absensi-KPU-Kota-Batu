<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\datangQrCode;
use App\Models\dinlur;
use App\Models\izin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class riwayatabsenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $cuti = Cuti::where('user_id', $userId)
            ->select(['id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'status'])
            ->get();

        $izins = Izin::where('user_id', $userId)
            ->select(['id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan','status'])
            ->get();

        $dinlur = Dinlur::where('user_id', $userId)
            ->select(['id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan','status'])
            ->get();

        $qrcode = DatangQrCode::whereIn('qrcode_id', function ($query) use ($userId) {
            $query->select('id')
                ->from('qrcode_gens')
                ->where('user_id', $userId);
        })
            ->select(['id', 'qrcode_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan','status'])
            ->get();

        $combinedData = $cuti->merge($izins)->merge($dinlur)->merge($qrcode);

        return view('Pegawai.riwayatAbsen', compact('combinedData'));
    }
}
