<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['role'];
        // TAMBAH INI: Kolom yang bisa dicari
        $searchableColumns = ['name', 'email'];

        // UBAH INI: Tambahkan search()
        $users = User::orderBy('created_at', 'DESC')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns) // TAMBAH INI
            ->paginate(10)
            ->withQueryString();

        return view('pages.user.index', compact('users'));
    }

    // Method lainnya tetap sama...
    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,guest',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,guest',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}