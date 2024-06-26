<?php

use App\Http\Controllers\absen_qr_codeController;
use App\Http\Controllers\absenPulang_qr_codeController;
use App\Http\Controllers\cutiController;
use App\Http\Controllers\dashboardPegawaiController;
use App\Http\Controllers\dinlurController;
use App\Http\Controllers\izinController;
use App\Http\Controllers\kepegawaianController;
use App\Http\Controllers\kepegawaianKasubag;
use App\Http\Controllers\nilaiAController;
use App\Http\Controllers\nilaiBController;
use App\Http\Controllers\nilaiCController;
use App\Http\Controllers\nilaiController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\qrcodeGenController;
use App\Http\Controllers\rekapController;
use App\Http\Controllers\rekapKasubagController;
use App\Http\Controllers\riwayatabsenController;
use App\Http\Controllers\satpamController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

// Route::get('/home', function () {
//     return redirect('/dashboardPegawai');
// });


Route::middleware(['auth'])->group(function () {
    // Route untuk pegawai
    Route::middleware(['auth', 'check.role:pegawai'])->group(function () {
        Route::get('/dashboardPegawai', [PegawaiController::class, 'index']);
        Route::post('/dashboardPegawai/qrcode', [PegawaiController::class, 'qrcodedatang']);
        Route::post('/dashboardPegawai/qrcodepulang', [PegawaiController::class, 'qrcodepulang']);
        Route::get('/dashboardPegawai/codePegawaiPulang', [qrcodeGenController::class, 'indexKaryawanPulang']);
        Route::get('/dashboardPegawai/codePegawai', [qrcodeGenController::class, 'indexKaryawan']);

        Route::prefix('/dashboardPegawai')->group(function () {
            Route::get('/izin', [izinController::class, 'index']);
            Route::post('/izin/store', [izinController::class, 'store']);
        });
        Route::prefix('/dashboardPegawai')->group(function () {
            Route::get('/cuti', [cutiController::class, 'index']);
            Route::post('/cuti/store', [cutiController::class, 'store']);
        });
        Route::prefix('/dashboardPegawai')->group(function () {
            Route::get('/dinasLuar', [dinlurController::class, 'index']);
            Route::post('/dinasLuar/store', [dinlurController::class, 'store']);
        });
        Route::prefix('/dashboardPegawai')->group(function () {
            Route::get('/riwayatAbsen', [riwayatabsenController::class, 'index']);
        });

        Route::prefix('/dashboardPegawai')->group(function () {
            Route::post('/codePegawai/qrcodeDatang/{id}', [qrcodeGenController::class, 'qrcodedatanggenul']);
        });
        Route::prefix('/dashboardPegawai')->group(function () {
            Route::delete('/codePegawai/qrcodeupdateStat/{id}', [qrcodeGenController::class, 'qrcodeupstat']);
        });

        Route::prefix('/dashboardPegawai')->group(function () {
            Route::put('/Pegawaiprofile/update/{id}', [PegawaiController::class, 'update']);
        });
    });

    // Route untuk admin
    Route::middleware(['auth', 'check.role:admin'])->group(function () {
        Route::get('/dashboardAdmin', [PegawaiController::class, 'admin']);

        Route::prefix('/dashboardAdmin')->group(function () {
            Route::get('/kepegawaian', [kepegawaianController::class, 'index']);
            Route::get('/kepegawaian/create', [kepegawaianController::class, 'create']);
            Route::post('/kepegawaian/store', [kepegawaianController::class, 'store']);
            Route::get('/kepegawaian/edit/{id}', [kepegawaianController::class, 'edit']);
            Route::put('/kepegawaian/update/{id}', [kepegawaianController::class, 'update']);
            Route::delete('/kepegawaian/destroy/{id}', [kepegawaianController::class, 'destroy']);
            Route::get('/kepegawaian/getPNS', [kepegawaianController::class, 'ambildataPns']);
            Route::get('/kepegawaian/getSatpam', [kepegawaianController::class, 'ambildataSatpam']);
            Route::get('/kepegawaian/getPPNPN', [kepegawaianController::class, 'ambildataPpnpn']);
            // Route::post('kepegawian/send-qr-code/all', [qrcodeGenController::class, 'sendQRCodeToAllEmployees'])->name('send.qr.code.all');
            // Route::post('kepegawian/send-qr-code-pulang/all', [qrcodeGenController::class, 'sendQRPulangCodeToAllEmployees'])->name('send.qr.code.pulang.all');
        });
        Route::prefix('/dashboardAdmin')->group(function () {
            Route::get('/cekRekap', [rekapController::class, 'index']);
            Route::get('/cekRekap/getPNS', [rekapController::class, 'rekapPNS']);
            Route::get('/cekRekap/getSatpam', [rekapController::class, 'rekapSatpam']);
            Route::get('/cekRekap/getPPNPN', [rekapController::class, 'rekapPPNPN']);
            Route::get('/cekRekap/show', [rekapController::class, 'show']);
        });
        Route::prefix('/dashboardAdmin')->group(function () {
            Route::get('/scanDatang', [absen_qr_codeController::class, 'index']);
            Route::post('/scanDatang/scan/store', [absen_qr_codeController::class, 'scanQrCodeDatangAdmin']);
        });
        Route::prefix('/dashboardAdmin')->group(function () {
            Route::get('/scanPulang', [absenPulang_qr_codeController::class, 'index']);
            Route::post('/scanPulang/scan/store', [absenPulang_qr_codeController::class, 'scanQrCodeDatang']);
        });
        Route::prefix('/dashboardAdmin')->group(function () {
            Route::post('/import-excel', [kepegawaianController::class, 'importUsers'])->name('import.file');
        });
    });

    // Route untuk adminSatpam
    Route::middleware(['auth', 'check.role:adminSatpam'])->group(function () {
        Route::get('/dashboardSatpam', [satpamController::class, 'index']);

        Route::prefix('/dashboardSatpam')->group(function () {
            Route::get('/scanDatang', [absen_qr_codeController::class, 'indexSatpam']);
            Route::post('/scanDatang/scan/store', [absen_qr_codeController::class, 'scanQrCodeDatangSatpam']);
        });
        Route::prefix('/dashboardSatpam')->group(function () {
            Route::get('/scanPulang', [absenPulang_qr_codeController::class, 'indexSatpam']);
            Route::post('/scanPulang/scan/store', [absenPulang_qr_codeController::class, 'scanQrCodeDatang']);
        });
    });

    // Route untuk kasubag
    Route::middleware(['auth', 'check.role:kasubag umum'])->group(function () {
        Route::get('/dashboardKasubag', [PegawaiController::class, 'kasubag']);

        Route::prefix('/dashboardKasubag')->group(function () {
            Route::get('/kepegawaian', [kepegawaianKasubag::class, 'index']);
            Route::get('/kepegawaian/laporan', [PdfController::class, 'generatePdf']);
            Route::get('/kepegawaian/laporan/{periode_id}', [kepegawaianKasubag::class, 'laporanfilter'])->name('printLaporan');
            Route::get('/kepegawaian/create', [kepegawaianKasubag::class, 'create']);
            Route::post('/kepegawaian/store', [kepegawaianKasubag::class, 'store']);
            Route::get('/kepegawaian/edit/{id}', [kepegawaianKasubag::class, 'edit']);
            Route::put('/kepegawaian/update/{id}', [kepegawaianKasubag::class, 'update']);
            Route::delete('/kepegawaian/destroy/{id}', [kepegawaianKasubag::class, 'destroy']);
            Route::get('/kepegawaian/getPNS', [kepegawaianKasubag::class, 'ambildataPns']);
            Route::get('/kepegawaian/getSatpam', [kepegawaianKasubag::class, 'ambildataSatpam']);
            Route::get('/kepegawaian/getPPNPN', [kepegawaianKasubag::class, 'ambildataPpnpn']);
            Route::get('/kepegawaian/nilai/{id}', [nilaiController::class, 'nilai']);
            Route::post('/kepegawaian/nilai/store', [nilaiController::class, 'simpan'])->name('simpan.nilai');
        });
        Route::prefix('/dashboardKasubag')->group(function () {
            Route::get('/cekRekap', [rekapKasubagController::class, 'index']);
            Route::get('/cekRekap/getPNS', [rekapKasubagController::class, 'rekapPNS']);
            Route::get('/cekRekap/getSatpam', [rekapKasubagController::class, 'rekapSatpam']);
            Route::get('/cekRekap/getPPNPN', [rekapKasubagController::class, 'rekapPPNPN']);
            Route::get('/cekRekap/show', [rekapKasubagController::class, 'show']);
        });
        Route::prefix('/dashboardKasubag')->group(function () {
            Route::get('/scanDatang', [absen_qr_codeController::class, 'indexKasubag']);
            Route::post('/scanDatang/scan/store', [absen_qr_codeController::class, 'scanQrCodeDatangKasubag']);
        });
        Route::prefix('/dashboardKasubag')->group(function () {
            Route::get('/scanPulang', [absenPulang_qr_codeController::class, 'indexKasubag']);
            Route::post('/scanPulang/scan/store', [absenPulang_qr_codeController::class, 'scanQrCodeDatang']);
        });
        Route::prefix('/dashboardKasubag')->group(function () {
            Route::get('/periode', [PeriodeController::class, 'index']);
            Route::get('/periode/create', [PeriodeController::class, 'create']);
            Route::post('/periode/store', [PeriodeController::class, 'store']);
            Route::get('/periode/edit/{id}', [PeriodeController::class, 'edit']);
            Route::delete('/periode/destroy/{id}', [PeriodeController::class, 'destroy']);
            Route::put('/periode/update/{id}', [PeriodeController::class, 'update']);
            Route::get('/periode/getdataperiode', [PeriodeController::class, 'getdataperiode'])->name('getdataperiode');
            Route::post('/periode/updateStatus', [PeriodeController::class, 'updateStatus'])->name('periode.updateStatus');
        });
        Route::prefix('/dashboardKasubag')->group(function () {
            Route::post('/import-excel', [kepegawaianKasubag::class, 'importUsers'])->name('import.process');
        });
    });
    // Route untuk logout
    Route::get('/logout', [SesiController::class, 'logout']);
});

Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);
