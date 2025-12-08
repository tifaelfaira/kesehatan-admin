<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['role'];
        $searchableColumns = ['name', 'email'];

        $users = User::orderBy('created_at', 'DESC')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('pages.user.index', compact('users'));
    }

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
            // HAPUS: 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // HAPUS: Bagian handle profile picture upload

        User::create($data);

        return redirect('/admin/user')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,guest',
            // HAPUS: 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('/admin/user')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // HAPUS: Kode untuk hapus foto profil
        $user->delete();
        
        return redirect('/admin/user')->with('success', 'User berhasil dihapus!');
    }
}