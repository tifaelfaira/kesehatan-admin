<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // JANGAN LUPA IMPORT INI

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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // VALIDASI FOTO
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        User::create($data);

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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // VALIDASI FOTO
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // Hapus foto profil jika ada
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}