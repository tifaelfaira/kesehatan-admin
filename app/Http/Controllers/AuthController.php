<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function index()
    {
        return view('login-form');
    }

    /**
     * Memproses data login.
     */
    public function login(Request $request)
    {
        // Validasi input dengan pesan error berbahasa Indonesia
        $request->validate([
            'username' => 'required|min:3',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/' // Harus ada huruf kapital
            ],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
            'password.regex' => 'Password harus mengandung huruf kapital.'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Cek login (simulasi)
        if ($username === 'Aira' && $password === 'Aira123') {
            return redirect('/admin/dashboard')->with('success', 'Login berhasil! Selamat datang, Admin.');
        } else {
            return back()->withErrors(['login' => 'Username atau password salah!'])->withInput();
        }
    }

    // Fungsi lain (kosong, bisa kamu isi nanti)
    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
