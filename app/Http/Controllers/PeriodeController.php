<?php

namespace App\Http\Controllers;

use App\Models\periode;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getdataperiode()
    {
        $periode = periode::select(['id', 'periode_bulan', 'periode_tahun', 'nip_nama_jabatan', 'nama_jabatan', 'status']);
        $index = 1;
        return DataTables::of($periode)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($row) {
                $editUrl = url('/dashboardKasubag/periode/edit/' . $row->id);
                $deleteUrl = url('/dashboardKasubag/kepegawaian/destroy/' . $row->id);


                return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->toJson();
    }
    public function index()
    {
        return view('kasubag.periode');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bulanOptions = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return view('kasubag.tambahperiode',compact('bulanOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'periode_bulan' => 'required',
            'periode_tahun' => 'required',
            'nama_jabatan' => 'required',
            'nip_nama_jabatan' => 'required',
            'status' => 'required|integer',
        ]);

        periode::create($request->all());

        return redirect('/dashboardKasubag/periode')
            ->with('success', 'Periode created successfully.');
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
        $periode = periode::findOrFail($id);
        $bulanOptions = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return view('kasubag.editPeriode', compact('periode','bulanOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'periode_bulan' => 'required',
            'periode_tahun' => 'required',
            'nama_jabatan' => 'required',
            'nip_nama_jabatan' => 'required',
            'status' => 'required|integer',
        ]);

        $periode = Periode::findOrFail($id);
        $periode->update($request->all());

        return redirect('/dashboardKasubag/periode')
            ->with('success', 'Periode updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $periode = periode::findOrFail($id);
        if (!$periode) {
            return response()->json(['error' => 'Periode not found'], 404);
        }

        $periode->delete();

        return response()->json(['message' => 'Periode deleted successfully'], 200);
    }
}
