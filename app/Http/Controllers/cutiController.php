<?php

namespace App\Http\Controllers;

use App\Models\cuti;
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

        // Check if the user has a "nip"
        if ($user->nip) {
            return view('cuti', compact('user'));
        } else {
            return redirect('/dashboardPegawai');
        }
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

        // Get the authenticated user (assuming you have authentication set up)
        $user = auth()->user();

        // Handle the file upload
        $file = $request->file('file');
        $filePath = $file->store('cuti_files', 'public');

        // Parse start and end dates directly from the request
        // Parse start and end dates from the request
        // Get the start and end dates of the leave period
        $startDate = Carbon::parse($request->tanggal_awal);
        $endDate = Carbon::parse($request->tanggal_akhir);

        // Create Absensi records for each day in the leave period
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $cuti = cuti::create([
                'tanggal_awal' => $startDate->toDateString(), // Start date remains the same
                'tanggal_akhir' => $endDate->toDateString(), // End date remains the same
                'tanggal' => $date->toDateString(), // Set the current date being iterated
                'file' => $filePath,
                'keterangan' => 'Tidak Hadir',
                'jam_datang' => null,
                'jam_pulang' => null,
                'user_id' => $user->id,
            ]);
        }

        return redirect('/dashboardPegawai')->with('success', 'Cuti berhasil disimpan');
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
