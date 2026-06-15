@extends('layouts.app')

@section('title', 'Layanan & Paket')
@section('header_title', 'Pengaturan Tarif Layanan & Paket Laundry')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm lg:col-span-1">
        <h3 class="font-bold text-slate-900 text-lg mb-4">Tambah Tarif / Paket</h3>
        <form action="{{ route('pos.services.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Layanan / Paket</label>
                <input type="text" name="name" required placeholder="Contoh: Paket Bulanan 30kg" class="w-full p-2.5 border border-slate-200 rounded-xl bg-slate-50 text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Kategori</label>
                <select name="category" class="w-full p-2.5 border border-slate-200 rounded-xl bg-slate-50 text-sm">
                    <option value="kiloan">Kiloan</option>
                    <option value="satuan">Satuan</option>
                    <option value="dry_clean">Dry Cleaning</option>
                    <option value="paket">Paket Kontrak / Bundling</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Harga (Rp)</label>
                    <input type="number" name="price" required placeholder="Harga Jual" class="w-full p-2.5 border border-slate-200 rounded-xl bg-slate-50 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Satuan Unit</label>
                    <input type="text" name="unit" required placeholder="kg, pcs, paket" class="w-full p-2.5 border border-slate-200 rounded-xl bg-slate-50 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Estimasi Selesai (Hari)</label>
                <input type="number" name="estimate_days" required placeholder="Contoh: 3" class="w-full p-2.5 border border-slate-200 rounded-xl bg-slate-50 text-sm">
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm p-3 rounded-xl shadow-md transition-all">
                Simpan Layanan
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm lg:col-span-2 overflow-x-auto">
        <h3 class="font-bold text-slate-900 text-lg mb-4">Daftar Harga Aktif</h3>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 text-slate-400 text-xs uppercase font-bold">
                    <th class="pb-3">Nama Layanan</th>
                    <th class="pb-3">Kategori</th>
                    <th class="pb-3">Tarif / Harga</th>
                    <th class="pb-3">Durasi Kerja</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @foreach($services as $service)
                <tr>
                    <td class="py-3.5 font-bold text-slate-800">{{ $service->name }}</td>
                    <td class="py-3.5">
                        <span class="px-2 py-0.5 text-[11px] font-bold rounded-md uppercase
                            {{ $service->category == 'paket' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-slate-100 text-slate-700' }}">
                            {{ $service->category }}
                        </span>
                    </td>
                    <td class="py-3.5 font-extrabold text-slate-900">Rp {{ number_format($service->price) }} <span class="text-xs font-normal text-slate-400">/ {{ $service->unit }}</span></td>
                    <td class="py-3.5 font-medium text-slate-600">⚡ {{ $service->estimate_days }} Hari Kerja</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
