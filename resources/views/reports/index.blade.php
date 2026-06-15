@extends('layouts.app')

@section('title', 'Laporan Keuangan')
@section('header_title', 'Ringkasan Pendapatan Laundry')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-indigo-600 rounded-2xl shadow-md p-6 text-white flex items-center justify-between">
        <div>
            <p class="text-indigo-100 text-sm font-semibold uppercase mb-1">Total Omset Keseluruhan</p>
            <h2 class="text-3xl font-bold font-mono">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
        </div>
        <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center text-2xl">
            💰
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 flex items-center justify-between">
        <div>
            <p class="text-slate-500 text-sm font-semibold uppercase mb-1">Total Cucian Masuk</p>
            <h2 class="text-3xl font-bold text-slate-800">{{ $totalTransaksi }} Transaksi</h2>
        </div>
        <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center text-2xl">
            🧾
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center">
        <h3 class="font-bold text-slate-800">Rincian Transaksi Keuangan</h3>
        <button onclick="window.print()" class="px-4 py-2 bg-slate-800 text-white text-sm font-semibold rounded-lg hover:bg-slate-900 transition-colors">
            🖨️ Cetak Laporan
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4 text-left">Tanggal</th>
                    <th class="px-6 py-4 text-left">No. Invoice</th>
                    <th class="px-6 py-4 text-left">Pelanggan</th>
                    <th class="px-6 py-4 text-left">Item Layanan</th>
                    <th class="px-6 py-4 text-right">Pendapatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($laporanTransaksi as $trx)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 text-slate-600">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 font-mono font-bold text-indigo-600">{{ $trx->invoice_code }}</td>
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $trx->customer->name ?? 'User Dihapus' }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $trx->service->name ?? 'Layanan Dihapus' }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-emerald-600 font-mono">
                        + Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada data keuangan untuk ditampilkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Styling khusus saat halaman dicetak */
    @media print {
        aside, nav, button { display: none !important; }
        main { padding: 0 !important; margin: 0 !important; width: 100% !important; }
        .shadow-sm, .shadow-md { box-shadow: none !important; }
    }
</style>
@endsection
