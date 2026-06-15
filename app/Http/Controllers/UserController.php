<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan halaman kelola pengguna
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,kasir',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        // Cegah admin menghapus dirinya sendiri
        if (auth()->id() == $id) {
            return redirect()->route('users.index')->withErrors('Anda tidak bisa menghapus akun Anda sendiri saat sedang login.');
        }

        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
