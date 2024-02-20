<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class izinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('izin');
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
            'lama_izin' => 'required',
            'file' => 'required|file|mimes:jpeg,png,pdf|max:10000', // Adjust the allowed file types and maximum size
        ]);

        // Get the current date in string format
        $currentDate = now()->toDateString();

        // Get the authenticated user (assuming you have authentication set up)
        $user = auth()->user();

        // Handle the file upload
        $file = $request->file('file');
        $filePath = $file->store('absensi_files', 'public');

        // Create the Absensi record
        $izin = Absensi::create([
            'tanggal' => $currentDate,
            'lama_izin' => $request->lama_izin,
            'file' => $filePath,
            'user_id' => $user->id,
        ]);

        return redirect('/dashboardPegawai')->with('success', 'Absensi berhasil disimpan');
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
