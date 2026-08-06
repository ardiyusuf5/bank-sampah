<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $petugas = Petugas::where('username', $request->username)->first();

        if (! $petugas) {
            return back()
                ->withErrors(['username' => 'Username tidak ditemukan.'])
                ->withInput($request->only('username'));
        }

        if (! Hash::check($request->password, $petugas->password)) {
            return back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput($request->only('username'));
        }

        Auth::login($petugas);
        $request->session()->regenerate();

        if ($petugas->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // if ($petugas->role === 'petugas') {
        //     return redirect()->route('petugas.dashboard');
        // }

        Auth::logout();

        Alert::error('Gagal!', 'Akun tidak memiliki role yang valid.');

        return back()->withInput($request->only('username'));
    }

    public function logout()
    {
        Auth::logout();

        Alert::success('Selamat Tinggal!', 'Anda telah berhasil logout.');

        return redirect()->route('login');
    }
}
