<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\datangQrCode;
use App\Models\dinlur;
use App\Models\izin;
use App\Models\periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class cutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id; // Retrieve the user ID

        // Check if the user has a "nip"
        if ($user->nip) {
            return view('Pegawai.cuti', compact('user'));
        } else {
            return redirect('/dashboardPegawai')->with('error', 'Anda tidak dapat cuti karena tidak memiliki NIP');
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png'
        ]);

        $userId = auth()->user()->id;
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Cek di datangqrcode, izin, dinlur
        $conflictingRecords = DatangQrCode::where('user_id', $userId)
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->exists() ||
            Izin::where('user_id', $userId)
            ->whereBetween('tanggal_awal', [$tanggalAwal, $tanggalAkhir])
            ->exists() ||
            Dinlur::where('user_id', $userId)
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->exists();

        if ($conflictingRecords) {
            return redirect()->back()->withErrors(['message' => 'Anda sudah memiliki data absensi pada tanggal tersebut.']);
        }

        // Ambil periode aktif
        $periodeAktif = Periode::where('status', 1)->first();
        if (!$periodeAktif) {
            return redirect()->back()->withErrors(['message' => 'Tidak ada periode aktif yang ditemukan.']);
        }

        // Jika tidak ada konflik, simpan data cuti
        $cuti = new Cuti();
        $cuti->user_id = $userId;
        $cuti->tanggal_awal = $tanggalAwal;
        $cuti->tanggal_akhir = $tanggalAkhir;
        $cuti->file = $request->file('file')->store('cuti_files', 'public');
        $cuti->tanggal = $tanggalAwal;
        $cuti->periode_id = $periodeAktif->id; // Tetapkan nilai periode aktif
        $cuti->save();

        return redirect('dashboardPegawai')->with('success', 'Cuti berhasil disimpan');
    }



    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'tanggal_awal' => 'required|date',
    //         'tanggal_akhir' => 'required|date',
    //         'file' => 'required|file|mimes:jpeg,png,pdf|max:10000', // Adjust the allowed file types and maximum size
    //     ]);

    //     $periode = periode::where('status', 1)->first();
    //     if (!$periode) {
    //         return redirect('/dashboardPegawai/dinasLuar')->withErrors(['errors' => 'Periode Belum Dibuka']);
    //     }
    //     // Get the authenticated user (assuming you have authentication set up)
    //     $user = auth()->user();

    //     // Handle the file upload
    //     $file = $request->file('file');
    //     $filePath = $file->store('cuti_files', 'public');

    //     // Parse start and end dates directly from the request
    //     // Parse start and end dates from the request
    //     // Get the start and end dates of the leave period
    //     $startDate = Carbon::parse($request->tanggal_awal);
    //     $endDate = Carbon::parse($request->tanggal_akhir);

    //     // Create Absensi records for each day in the leave period
    //     for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
    //         $cuti = cuti::create([
    //             'tanggal_awal' => $startDate->toDateString(), // Start date remains the same
    //             'tanggal_akhir' => $endDate->toDateString(), // End date remains the same
    //             'tanggal' => $date->toDateString(), // Set the current date being iterated
    //             'file' => $filePath,
    //             'keterangan' => 'Tidak Hadir',
    //             'jam_datang' => null,
    //             'jam_pulang' => null,
    //             'user_id' => $user->id,
    //             'periode_id' => $periode->id,
    //         ]);
    //     }

    //     return redirect('/dashboardPegawai')->with('success', 'Cuti berhasil disimpan');
    // }

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
