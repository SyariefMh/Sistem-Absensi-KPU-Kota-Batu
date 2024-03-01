<?php

namespace App\Http\Controllers;

use App\Models\datangQrCode;
use App\Models\pulangQrCode;
use App\Models\qrcodeGen;
use App\Models\User;
use Illuminate\Http\Request;

class absenPulang_qr_codeController extends Controller
{
    public function index()
    {
        return view('codePulangAdmin');
    }
    public function scanQrCodeDatang(Request $request)
    {
        $qrCodeData = $request->input('qrcodefilesPlg');
        $qrCodes = qrcodeGen::where('qrcode_pulang', $qrCodeData) // Use $desiredUserId directly as the user ID
            ->first();

        if (!$qrCodes) {
            return response()->json(['error' => 'QR code not found'], 400);
        }


        $qrCodeScan = pulangQrCode::where('qrcode_id', $qrCodes->id)
            ->whereDate('tanggal', now()->toDateString())
            ->exists();

        if ($qrCodeScan) {
            // return redirect('/dashboardkaryawan/Absensi/LiveLocation')->with('error', 'QR Code sudah discan sebelumnya.');
            return response()->json(['message' => 'QR Code sudah discan sebelumnya.'], 400);
        }
        pulangQrCode::create([
            'qrcode_id' => $qrCodes->id,
            'tanggal' => now()->toDateString(),
            'jam_datang' => null,
            'jam_pulang' => now()->toTimeString(),
            'keterangan' => 'Hadir',
        ]);

        return response()->json(['success' => 'Absensi berhasil dicatat.'], 200);
    }
}
