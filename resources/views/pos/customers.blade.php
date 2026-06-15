@extends('layouts.app')

@section('title', 'Data Pelanggan')
@section('header_title', 'Manajemen Database Pelanggan & Loyalty Points')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm lg:col-span-1">
        <h3 class="font-bold text-slate-900 text-lg mb-4">Tambah Pelanggan Baru</h3>
        <form action="{{ route('pos.customers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Contoh: Budi Santoso" class="w-full p-2.5 border border-slate-200 rounded-xl bg-slate-50 text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">No. WhatsApp</label>
                <input type="text" name="phone" required placeholder="Contoh: 08123456789" class="w-full p-2.5 border border-slate-200 rounded-xl bg-slate-50 text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Alamat Rumah</label>
                <textarea name="address" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW..." class="w-full p-2.5 border border-slate-200 rounded-xl bg-slate-50 text-sm"></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm p-3 rounded-xl shadow-md transition-all">
                Daftarkan Pelanggan
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm lg:col-span-2 overflow-x-auto">
        <h3 class="font-bold text-slate-900 text-lg mb-4">Database Member</h3>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 text-slate-400 text-xs uppercase font-bold">
                    <th class="pb-3">Nama</th>
                    <th class="pb-3">Kontak / Alamat</th>
                    <th class="pb-3">Loyalty Points</th>
                    <th class="pb-3">Total Order</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @foreach($customers as $customer)
                <tr>
                    <td class="py-3.5 font-bold text-slate-800">{{ $customer->name }}</td>
                    <td class="py-3.5 text-xs text-slate-600">
                        <span class="block font-semibold text-slate-700">📱 {{ $customer->phone }}</span>
                        <span class="block text-slate-400 mt-0.5">📍 {{ $customer->address }}</span>
                    </td>
                    <td class="py-3.5 font-bold text-emerald-600">{{ $customer->points }} pts</td>
                    <td class="py-3.5 font-medium text-slate-600">{{ $customer->total_orders }}x Transaksi</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
