@extends('layouts.app')

@section('title', 'Dashboard - Natasya Laundry')
@section('header_title', 'Dashboard Utama')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center mt-10">
    <div class="w-20 h-20 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
        👋
    </div>
    <h2 class="text-2xl font-bold text-slate-800 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p class="text-slate-500 max-w-lg mx-auto">
        Anda login sebagai <span class="font-bold text-indigo-600 uppercase">{{ Auth::user()->role }}</span>.
        Gunakan menu di sebelah kiri untuk mengelola transaksi, data pelanggan, dan layanan laundry.
    </p>

    <div class="mt-8 flex justify-center gap-4">
        <a href="{{ route('transactions.create') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition-all">
            + Buat Transaksi Kasir
        </a>
        <a href="{{ route('transactions.index') }}" class="px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold rounded-xl shadow-sm transition-all">
            Lihat Antrian Cucian
        </a>
    </div>
</div>
@endsection
