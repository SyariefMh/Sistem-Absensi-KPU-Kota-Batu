<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('loginPage');
    }
    function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ], [
            'name.required' => 'nama wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'name' => $request->name,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            $user = Auth::user();
            if ($user->role === 'pegawai') {
                return redirect('dashboardPegawai');
            } elseif ($user->role === 'admin') {
                return redirect('dashboardAdmin');
            } elseif ($user->role === 'kasubag umum') {
                return redirect('dashboardKasubag');
            }
        } else {
            return redirect('')->withErrors('Nama dan password tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
