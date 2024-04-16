<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\datangQrCode;
use App\Models\dinlur;
use App\Models\izin;
use App\Models\periode;
use App\Models\qrcodeGen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class dinlurController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id; // Retrieve the user ID

        // Retrieve records for cuti and izin models for the logged-in user
        $cuti = Cuti::where('user_id', $userId)->pluck('tanggal')->toArray();
        $izins = Izin::where('user_id', $userId)->pluck('tanggal')->toArray();
        $qrcode = DatangQrCode::whereIn('qrcode_id', function ($query) use ($userId) {
            $query->select('id')
                ->from('qrcode_gens')
                ->whereIn('user_id', [$userId]); // wrap $userId in an array
        })->pluck('tanggal')->toArray();

        // Combine the dates of cuti, izin, and qrcode records
        $combinedDates = collect($cuti)->merge($izins)->merge($qrcode)->unique();



        // Check if there are any records for cuti or izin on today's date
        $today = now()->toDateString();
        $absensiDisabled = $combinedDates->contains($today);

        if ($absensiDisabled) {
            return redirect('dashboardPegawai')->withErrors('Sudah Absen');
        }
        return view('Pegawai.dinasLuar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'file' => 'required|file|mimes:jpeg,png,pdf|max:10000',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        $periode = periode::where('status', 1)->first();
        if(!$periode){
            return redirect('/dashboardPegawai/dinasLuar')->withErrors(['errors' => 'Periode Belum Dibuka']);
        }
        // Handle the file upload
        $file = $request->file('file');
        $filePath = $file->store('dinlur', 'public');

        // Create DinasLuar record
        $dinasLuar = dinlur::create([
            'tanggal' => $request->tanggal,
            'jam_datang' => $request->jam_datang, // Assuming these are not provided in the form
            'jam_pulang' => $request->jam_pulang,
            'Keterangan' => 'Hadir', // Assuming it's always 'Hadir'
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'file' => $filePath,
            'periode_id' => $periode->id,
            'user_id' => auth()->id(), // Use authenticated user's ID
        ]);
        // dd($dinasLuar);
        return redirect('/dashboardPegawai')->with('success', 'Absensi dinas luar berhasil disimpan');
    }
}
