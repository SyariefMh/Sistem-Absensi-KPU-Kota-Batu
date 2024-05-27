<?php

namespace App\Http\Controllers;

use App\Models\periode;
use App\Models\Izin;
use App\Models\Cuti;
use App\Models\Dinlur;
use App\Models\DatangQrCode;
use Illuminate\Support\Facades\Log;
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
                $deleteUrl = url('/dashboardKasubag/periode/destroy/' . $row->id);
                if ($row->status != 1) {
                    return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a>';
                } else {
                    return '<a href="' . $editUrl . '">Edit</a>';
                }
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

        return view('kasubag.tambahperiode', compact('bulanOptions'));
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

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:periode,id',
            'status' => 'required|boolean',
        ]);

        $periode = Periode::find($request->id);
        // Validasi jika status yang akan diaktifkan adalah 1 (Active)
        if ($request->status == 1) {
            // Cek apakah ada periode lain yang sudah aktif
            $existingActivePeriode = Periode::where('status', 1)
                ->where('id', '!=', $request->id) // Exclude the current periode
                ->first();

            if ($existingActivePeriode) {
                return response()->json(['success' => false, 'message' => 'Ada periode lain yang sudah aktif. Nonaktifkan terlebih dahulu.']);
            }
        }
        $periode->status = $request->status;
        $periode->save();

        return response()->json(['success' => true]);
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

        return view('kasubag.editPeriode', compact('periode', 'bulanOptions'));
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
    public function destroy($id)
    {
        Log::info('Destroy method called with id: ' . $id);

        try {
            $periode = Periode::find($id);
            if (!$periode) {
                Log::error('Periode not found with id: ' . $id);
                return response()->json(['error' => 'Periode not found'], 404);
            }


            // Hapus data terkait di tabel izins, cutis, dinlurs, dan datangqrcode
            Izin::where('periode_id', $id)->delete();
            Log::info('Related izins deleted for periode id: ' . $id);

            Cuti::where('periode_id', $id)->delete();
            Log::info('Related cutis deleted for periode id: ' . $id);

            Dinlur::where('periode_id', $id)->delete();
            Log::info('Related dinlurs deleted for periode id: ' . $id);

            DatangQrCode::where('periode_id', $id)->delete();
            Log::info('Related datangqrcode deleted for periode id: ' . $id);

            // Hapus periode
            $periode->delete();
            Log::info('Periode deleted successfully with id: ' . $id);

            return response()->json(['message' => 'Periode deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting periode: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    // public function destroy($id)
    // {
    //     $periode = Periode::find($id);
    //     if (!$periode) {
    //         return response()->json(['error' => 'Periode not found'], 404);
    //     }

    //     $periode->delete();

    //     return response()->json(['message' => 'Periode deleted successfully'], 200);
    // }
}
