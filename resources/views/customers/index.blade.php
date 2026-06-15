@extends('layouts.app')

@section('title', 'Data Pelanggan')
@section('header_title', 'Kelola Pelanggan & Member')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">Tambah Pelanggan Baru</h3>

        @if($errors->any())
            <div class="mb-4 p-3 bg-rose-50 text-rose-700 text-xs rounded-xl">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Pelanggan</label>
                <input type="text" name="name" required placeholder="Nama Lengkap"
                    class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">No. Telepon</label>
                <input type="text" name="phone" placeholder="Contoh: 0812345678"
                    class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Alamat</label>
                <textarea name="address" rows="3" placeholder="Alamat rumah..."
                    class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500"></textarea>
            </div>

            <div class="p-3 bg-indigo-50 border border-indigo-100 rounded-xl flex items-center space-x-3">
                <input type="checkbox" name="is_member" id="is_member" value="1" class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                <label Akses untuk="is_member" class="text-sm font-semibold text-indigo-900 cursor-pointer">
                    Daftarkan sebagai Member ⭐ <br>
                    <span class="text-xs font-normal text-indigo-600">(Otomatis Diskon 10% setiap transaksi)</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm p-3 rounded-xl shadow-md transition-all">
                Simpan Pelanggan
            </button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h3 class="font-bold text-slate-800">Daftar Pelanggan Natasya Laundry</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4 text-left">Kode</th>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Telepon</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-mono text-slate-500 font-bold">{{ $customer->customer_code }}</td>
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $customer->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $customer->phone ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($customer->is_member)
                                <span class="px-2.5 py-1 bg-amber-100 text-amber-800 border border-amber-200 text-xs font-bold rounded-full">⭐ MEMBER</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-xs rounded-full">Regular</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if(Auth::user()->role === 'admin')
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Hapus data pelanggan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold text-xs bg-rose-50 px-3 py-1 rounded-md">Hapus</button>
                            </form>
                            @else
                            <span class="text-xs text-slate-400 italic">No Action</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada data pelanggan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
