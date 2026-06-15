@extends('layouts.app')

@section('title', 'Transaksi Baru')
@section('header_title', 'Input Transaksi Laundry Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Pilih Pelanggan</label>
            <select name="customer_id" required class="w-full p-3 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone ?? '-' }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Layanan Laundry</label>
            <select name="service_id" required class="w-full p-3 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
                <option value="">-- Pilih Jasa & Tarif --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} - Rp {{ number_format($service->price, 0, ',', '.') }} / {{ $service->unit }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Jumlah / Berat (Kg atau Pcs)</label>
            <input type="number" step="0.1" name="qty" required placeholder="Contoh: 3.5 atau 2"
                class="w-full p-3 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-indigo-500">
            <p class="text-xs text-slate-400 mt-1">*Gunakan tanda titik (.) untuk nilai desimal/pecahan.</p>
        </div>

        <div class="pt-4 flex space-x-3">
            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm p-3 rounded-xl shadow-md transition-all text-center">
                Simpan & Buat Invoice
            </button>
            <a href="{{ route('transactions.index') }}" class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-sm rounded-xl transition-all text-center">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
