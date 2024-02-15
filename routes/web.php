<?php

use App\Http\Controllers\PegawaiController;
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
    Route::get('/dashboardPegawai', [PegawaiController::class, 'index']);
    Route::get('/dashboardAdmin', [PegawaiController::class, 'admin']);
    Route::get('/dashboardKasubag', [PegawaiController::class, 'kasubag']);
    Route::get('/logout', [SesiController::class, 'logout']);
});


// Route::get('/dashboardAdmin', function () {
//     return view('dashboardAdmin');
// });

// Route::get('/dashboardKasubag', function () {
//     return view('dashboardKasubag');
// });

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
