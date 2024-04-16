<?php

namespace App\Http\Controllers;

use App\Models\datangQrCode;
use App\Models\periode;
use App\Models\qrcodeGen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class absen_qr_codeController extends Controller
{
    public function index()
    {
        return view('codeAdmin');
    }
    public function scanQrCodeDatang(Request $request)
    {
        $qrCodeData = $request->input('qrcodefilesDtg');
        $qrCodes = qrcodeGen::where('qrcode_datang', $qrCodeData) // Use $desiredUserId directly as the user ID
            ->first();

        if (!$qrCodes) {
            return response()->json(['error' => 'QR code not found'], 400);
        }


        $qrCodeScan = datangQrCode::where('qrcode_id', $qrCodes->id)
            ->whereDate('tanggal', now()->toDateString())
            ->exists();

        if ($qrCodeScan) {
            // return redirect('/dashboardkaryawan/Absensi/LiveLocation')->with('error', 'QR Code sudah discan sebelumnya.');
            return response()->json(['message' => 'QR Code sudah discan sebelumnya.'], 400);
        }

        if ($qrCodes->status == 0) {
            return response()->json(['message' => 'QR code is not usable'], 400);
        }
        // Get the current time
        $currentTime = now();

        // Set the target time for comparison (07:45:00)
        $targetTime = Carbon::createFromTime(7, 45, 0);

        // Initialize status variable
        $status = '';

        // Check if the current time is after the target time
        if ($currentTime > $targetTime) {
            $status = 'Terlambat';
        } else if ($currentTime < $targetTime) {
            $status = 'Tepat Waktu';
        }

        // Convert the current time to string
        $currentTimeString = $currentTime->toTimeString();

        // Retrieve user_id from qrcodeGen
        $userId = $qrCodes->user_id;

        $periode = periode::where('status', 1)->first();
        if(!$periode){
            return redirect('/dashboardPegawai/dinasLuar')->withErrors(['errors' => 'Periode Belum Dibuka']);
        }

        datangQrCode::create([
            'qrcode_id' => $qrCodes->id,
            'user_id' => $userId, // Assign user_id from qrcodeGen
            'tanggal' => now()->toDateString(),
            'jam_datang' => $currentTimeString,
            'jam_pulang' => null,
            'keterangan' => 'Hadir',
            'periode_id' => $periode->id,
            'Status' => $status,
        ]);


        return response()->json(['success' => 'Absensi berhasil dicatat.'], 200);
    }
}
