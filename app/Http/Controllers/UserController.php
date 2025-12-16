<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private array $roles = ['super_admin', 'admin', 'petugas'];

    public function index()
    {
        $users = User::with('profilePhoto')->latest()->paginate(10);
        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.create', ['roles' => $this->roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'username' => 'required|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:super_admin,admin,petugas',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // =========================
        // UPLOAD FOTO (JIKA ADA)
        // =========================
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $fileName = time().'_'.uniqid().'.'.$file->extension();

            // ⬇⬇ PASTI MASUK: storage/app/public/media
            Storage::disk('public')->putFileAs(
                'media',
                $file,
                $fileName
            );

            Media::create([
                'ref_table' => 'users',
                'ref_id'    => $user->id,
                'file_name' => $fileName,
                'mime_type' => $file->getMimeType(),
                'sort_order'=> 0,
            ]);
        }

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function show(User $user)
    {
        $user->load('profilePhoto');
        return view('pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', [
            'user'  => $user,
            'roles' => $this->roles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:super_admin,admin,petugas',
            'password' => 'nullable|min:6',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->update($request->only('name','username','email','role'));

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        // =========================
        // UPDATE FOTO (JIKA ADA)
        // =========================
        if ($request->hasFile('photo')) {

            // hapus foto lama (jika ada)
            if ($user->profilePhoto) {
                Storage::disk('public')
                    ->delete('media/'.$user->profilePhoto->file_name);

                $user->profilePhoto->delete();
            }

            $file = $request->file('photo');
            $fileName = time().'_'.uniqid().'.'.$file->extension();

            Storage::disk('public')->putFileAs(
                'media',
                $file,
                $fileName
            );

            Media::create([
                'ref_table' => 'users',
                'ref_id'    => $user->id,
                'file_name' => $fileName,
                'mime_type' => $file->getMimeType(),
                'sort_order'=> 0,
            ]);
        }

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->profilePhoto) {
            Storage::disk('public')
                ->delete('media/'.$user->profilePhoto->file_name);

            $user->profilePhoto->delete();
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }
}
