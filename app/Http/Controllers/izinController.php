<?php

namespace App\Http\Controllers;

use App\Models\datangQrCode;
use App\Models\dinlur;
use App\Models\izinmodel;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\izin;
use App\Models\cuti;
use App\Models\periode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class izinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id; // Retrieve the user ID

        // Retrieve records for cuti and izin models for the logged-in user
        $cuti = Cuti::where('user_id', $userId)->pluck('tanggal')->toArray();
        $izins = Izin::where('user_id', $userId)->pluck('tanggal')->toArray();
        $dinlur = dinlur::where('user_id', $userId)->pluck('tanggal')->toArray();
        $qrcode = datangQrCode::whereIn('qrcode_id', function ($query) use ($userId) {
            $query->select('id')
                ->from('qrcode_gens')
                ->whereIn('user_id', [$userId]); // wrap $userId in an array
        })->pluck('tanggal')->toArray();

        // Combine the dates of cuti, izin, and qrcode records
        $combinedDates = collect($cuti)->merge($dinlur)->merge($izins)->merge($qrcode)->unique();



        // Check if there are any records for cuti or izin on today's date
        $today = now()->toDateString();
        $absensiDisabled = $combinedDates->contains($today);

        if ($absensiDisabled) {
            return redirect('dashboardPegawai')->withErrors('Sudah Absen');
        }
        return view('Pegawai.izin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'file' => 'required|file|mimes:jpeg,png,pdf|max:10000', // Adjust the allowed file types and maximum size
        ]);
        $periode = periode::where('status', 1)->first();
        if (!$periode) {
            return redirect('/dashboardPegawai/dinasLuar')->withErrors(['errors' => 'Periode Belum Dibuka']);
        }

        // Get the authenticated user (assuming you have authentication set up)
        $user = auth()->user();

        // Handle the file upload
        $file = $request->file('file');
        $filePath = $file->store('absensi_files', 'public');

        // Parse start and end dates directly from the request
        // Parse start and end dates from the request
        // Get the start and end dates of the leave period
        $startDate = Carbon::parse($request->tanggal_awal);
        $endDate = Carbon::parse($request->tanggal_akhir);

        // Create Absensi records for each day in the leave period
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $izin = izin::create([
                'tanggal_awal' => $startDate->toDateString(), // Start date remains the same
                'tanggal_akhir' => $endDate->toDateString(), // End date remains the same
                'tanggal' => $date->toDateString(), // Set the current date being iterated
                'file' => $filePath,
                'keterangan' => 'Tidak Hadir',
                'jam_datang' => null,
                'jam_pulang' => null,
                'periode_id' => $periode->id,
                'user_id' => $user->id,
            ]);
        }

        return redirect('/dashboardPegawai')->with('success', 'Izin berhasil disimpan');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
