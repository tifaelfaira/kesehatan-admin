<?php
// app/Http\Controllers\UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Constructor dihapus karena sudah dilindungi oleh middleware di route
    // Middleware 'role:super_admin,admin' di routes/web.php sudah mencukupi

    public function index(Request $request)
    {
        $user = Auth::user();
        $filterableColumns = ['role'];
        $searchableColumns = ['name', 'username', 'email'];

        $users = User::orderBy('created_at', 'DESC')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns);

        // Jika bukan super admin, hanya bisa lihat admin dan petugas
        if (!$user->isSuperAdmin()) {
            $users = $users->where('role', '!=', 'super_admin');
        }

        $users = $users->paginate(10)->withQueryString();

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        $user = Auth::user();
        $roles = $this->getAvailableRoles($user);

        return view('pages.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => ['required', Rule::in($this->getAvailableRoles($user))],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $currentUser = Auth::user();

        // Cek hak akses edit
        $this->checkEditAccess($currentUser, $user);

        $roles = $this->getAvailableRoles($currentUser);

        return view('pages.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $currentUser = Auth::user();

        // Cek hak akses update
        $this->checkEditAccess($currentUser, $user);

        $request->validate([
            'name' => 'required|min:3',
            'username' => [
                'required',
                'min:3',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:6|confirmed',
            'role' => ['required', Rule::in($this->getAvailableRoles($currentUser))],
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        // Tidak boleh menghapus diri sendiri
        if ($currentUser->id === $user->id) {
            return redirect()->route('user.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        // Cek hak akses delete
        $this->checkDeleteAccess($currentUser, $user);

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus!');
    }

    /**
     * Mendapatkan roles yang tersedia berdasarkan role user saat ini
     */
    private function getAvailableRoles(User $user): array
    {
        if ($user->isSuperAdmin()) {
            return ['super_admin', 'admin', 'petugas'];
        } elseif ($user->isAdmin()) {
            return ['admin', 'petugas'];
        }

        return ['petugas'];
    }

    /**
     * Cek hak akses edit
     */
    private function checkEditAccess(User $currentUser, User $targetUser): void
    {
        // Super admin bisa edit semua
        if ($currentUser->isSuperAdmin()) {
            return;
        }

        // Admin hanya bisa edit admin dan petugas, tidak bisa edit super admin
        if ($currentUser->isAdmin()) {
            if ($targetUser->isSuperAdmin()) {
                abort(403, 'Admin tidak dapat mengedit Super Admin.');
            }
            return;
        }

        // Petugas tidak bisa edit siapa pun
        abort(403, 'Petugas tidak memiliki akses untuk mengedit user.');
    }

    /**
     * Cek hak akses delete
     */
    private function checkDeleteAccess(User $currentUser, User $targetUser): void
    {
        // Super admin bisa delete semua kecuali diri sendiri
        if ($currentUser->isSuperAdmin()) {
            if ($currentUser->id === $targetUser->id) {
                abort(403, 'Tidak dapat menghapus akun sendiri.');
            }
            return;
        }

        // Admin hanya bisa delete petugas
        if ($currentUser->isAdmin()) {
            if ($targetUser->isSuperAdmin() || $targetUser->isAdmin()) {
                abort(403, 'Admin hanya dapat menghapus petugas.');
            }
            return;
        }

        // Petugas tidak bisa delete siapa pun
        abort(403, 'Petugas tidak memiliki akses untuk menghapus user.');
    }
}