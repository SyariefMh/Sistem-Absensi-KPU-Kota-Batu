<?php

namespace App\Http\Controllers;

use App\Models\dinlur;
use Carbon\Carbon;
use Illuminate\Http\Request;


class dinlurController extends Controller
{
    public function index()
    {
        return view('dinasLuar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'file' => 'required|file|mimes:jpeg,png,pdf|max:10000',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

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
            'user_id' => auth()->id(), // Use authenticated user's ID
        ]);

        return redirect('/dashboardPegawai')->with('success', 'Absensi dinas luar berhasil disimpan');
    }
}
