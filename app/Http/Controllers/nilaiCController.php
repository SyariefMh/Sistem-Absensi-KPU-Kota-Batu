<?php

namespace App\Http\Controllers;

use App\Models\nilaiC;
use Illuminate\Http\Request;

class nilaiCController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function simpan(Request $request)
    {
        // Validasi data jika diperlukan
        $validatedData = $request->validate([
            'kriteria1' => 'required',
            'kriteria2' => 'required',
            'kriteria3' => 'required',
            'kriteria4' => 'required',
            'nilai1' => 'required|numeric',
            'nilai2' => 'required|numeric',
            'nilai3' => 'required|numeric',
            'nilai4' => 'required|numeric',
            'user_id' => 'required',
            'periode_id' => 'required',
        ]);

        // Simpan data ke database
        $exitingData = nilaiC::where('user_id', $request->user_id)->first();
        if ($exitingData) {
            $exitingData->update([
                'kriteria1' => $request->kriteria1,
                'kriteria2' => $request->kriteria2,
                'kriteria3' => $request->kriteria3,
                'kriteria4' => $request->kriteria4,
                'nilai1' => $request->nilai1,
                'nilai2' => $request->nilai2,
                'nilai3' => $request->nilai3,
                'nilai4' => $request->nilai4,
                'user_id' => $request->user_id,
                'periode_id' => $request->periode_id,
            ]);
        } else {
            nilaiC::create([
                'kriteria1' => $request->kriteria1,
                'kriteria2' => $request->kriteria2,
                'kriteria3' => $request->kriteria3,
                'kriteria4' => $request->kriteria4,
                'nilai1' => $request->nilai1,
                'nilai2' => $request->nilai2,
                'nilai3' => $request->nilai3,
                'nilai4' => $request->nilai4,
                'user_id' => $request->user_id,
                'periode_id' => $request->periode_id,
                // Sesuaikan dengan kolom lain yang ada dalam model NilaiA
            ]);
        }

        // Redirect atau kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
    
     public function index()
    {
        //
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
        //
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
