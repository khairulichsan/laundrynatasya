@extends('layouts.app')

@section('title', 'Layanan Jasa')
@section('header_title', 'Kelola Tarif Layanan Laundry')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">Tambah Layanan Baru</h3>

        <form action="{{ route('services.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Layanan</label>
                <input type="text" name="name" required placeholder="Contoh: Cuci Komplit"
                    class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Harga (Rp)</label>
                <input type="number" name="price" required placeholder="Contoh: 7000"
                    class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Satuan</label>
                <select name="unit" required class="w-full p-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
                    <option value="Kg">Per Kilogram (Kg)</option>
                    <option value="Pcs">Per Potong/Lembar (Pcs)</option>
                    <option value="Meter">Per Meter</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm p-3 rounded-xl shadow-md transition-all">
                Simpan Layanan
            </button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h3 class="font-bold text-slate-800">Daftar Tarif Aktif</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4 text-left">Nama Layanan</th>
                        <th class="px-6 py-4 text-left">Harga</th>
                        <th class="px-6 py-4 text-left">Satuan</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($services as $service)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $service->name }}</td>
                        <td class="px-6 py-4 text-slate-600 font-mono">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $service->unit }}</td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold text-xs bg-rose-50 px-3 py-1 rounded-md">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500">Belum ada layanan yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
