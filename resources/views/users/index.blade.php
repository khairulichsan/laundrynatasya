@extends('layouts.app')

@section('title', 'Kelola Pengguna')
@section('header_title', 'Manajemen Akses Pengguna')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">Tambah Akun Baru</h3>

        @if($errors->any())
            <div class="mb-4 p-3 bg-rose-50 text-rose-700 text-xs rounded-xl">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Username Login</label>
                <input type="text" name="username" required class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Password</label>
                <input type="password" name="password" required class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Hak Akses (Role)</label>
                <select name="role" required class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
                    <option value="kasir">Kasir</option>
                    <option value="admin">Admin / Pemilik</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm p-3 rounded-xl shadow-md transition-all">
                Simpan Akun
            </button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h3 class="font-bold text-slate-800">Daftar Akun Terdaftar</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Username</th>
                        <th class="px-6 py-4 text-left">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->username }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-bold rounded-full uppercase {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if(auth()->id() != $user->id)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus akun ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold text-xs bg-rose-50 px-3 py-1 rounded-md">Hapus</button>
                            </form>
                            @else
                            <span class="text-xs text-slate-400 italic">Sedang Dipakai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
