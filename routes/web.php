<?php

use App\Http\Controllers\cutiController;
use App\Http\Controllers\dinlurController;
use App\Http\Controllers\izinController;
use App\Http\Controllers\kepegawaianController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\rekapController;
use App\Http\Controllers\riwayatabsenController;
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

Route::get('/home', function () {
    return redirect('/dashboardPegawai');
});


Route::middleware(['auth'])->group(function () {
    // Route untuk pegawai
    Route::middleware(['auth', 'check.role:pegawai'])->group(function () {
        Route::get('/dashboardPegawai', [PegawaiController::class, 'index']);

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
        });
        Route::prefix('/dashboardAdmin')->group(function () {
            Route::get('/cekRekap', [rekapController::class, 'index']);
            Route::get('/cekRekap/getPNS', [rekapController::class, 'rekapPNS']);
        });
    });

    // Route untuk kasubag
    Route::middleware(['auth', 'check.role:kasubag umum'])->group(function () {
        Route::get('/dashboardKasubag', [PegawaiController::class, 'kasubag']);
    });
    // Route untuk logout
    Route::get('/logout', [SesiController::class, 'logout']);
});


Route::get('/codePegawai', function () {
    return view('codePegawai');
});

Route::get('/codeAdmin', function () {
    return view('codeAdmin');
});

Route::get('/dinasLuar', function () {
    return view('dinasLuar');
});

Route::get('/izin', function () {
    return view('izin');
});

Route::get('/cuti', function () {
    return view('cuti');
});

Route::get('/riwayatAbsen', function () {
    return view('riwayatAbsen');
});

Route::get('/cekRekap', function () {
    return view('cekRekap');
});

Route::get('/dataPegawai', function () {
    return view('dataPegawai');
});

Route::get('/tambahPegawai', function () {
    return view('tambahPegawai');
});

Route::get('/penilaianPegawai', function () {
    return view('penilaianPegawai');
});

Route::get('/editpegawai', function () {
    return view('editpegawai');
});
