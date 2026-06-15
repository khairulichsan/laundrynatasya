@extends('layouts.app')

@section('title', 'Ubah Status Transaksi')
@section('header_title', 'Update Status Transaksi')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200">
        <h3 class="font-bold text-slate-800 text-lg">Nota: {{ $transaction->invoice_number }}</h3>
        <p class="text-sm text-slate-500">Pelanggan: {{ $transaction->customer->name }}</p>
    </div>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Status Cucian</label>
            <select name="status" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                <option value="proses" {{ $transaction->status == 'proses' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="selesai" {{ $transaction->status == 'selesai' ? 'selected' : '' }}>Selesai Cuci</option>
                <option value="diambil" {{ $transaction->status == 'diambil' ? 'selected' : '' }}>Sudah Diambil</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Status Pembayaran</label>
            <select name="payment_status" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                <option value="belum_lunas" {{ $transaction->payment_status == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="lunas" {{ $transaction->payment_status == 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>

        <div class="pt-4 flex justify-end space-x-3">
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-50 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
