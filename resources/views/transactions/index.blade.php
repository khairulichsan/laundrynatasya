@extends('layouts.app')

@section('title', 'Data Transaksi')
@section('header_title', 'Antrean Transaksi Laundry')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center">
        <h3 class="font-bold text-slate-800">Daftar Cucian Masuk</h3>
        <a href="{{ route('transactions.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
            + Transaksi Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4 text-left">No. Invoice</th>
                    <th class="px-6 py-4 text-left">Pelanggan</th>
                    <th class="px-6 py-4 text-left">Layanan</th>
                    <th class="px-6 py-4 text-left">Berat/Qty</th>
                    <th class="px-6 py-4 text-left">Total Harga</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Pembayaran</th> <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($transactions as $trx)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-mono font-bold text-indigo-600">{{ $trx->invoice_number }}</td>
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $trx->customer->name ?? 'Pelanggan Dihapus' }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $trx->details->first()->service->service_name ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-600 font-mono">{{ $trx->details->first()->quantity ?? 0 }}</td>
                    <td class="px-6 py-4 font-semibold text-slate-800 font-mono">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>

                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold rounded-full uppercase">
                            {{ $trx->status }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if($trx->payment_status == 'lunas')
                            <span class="px-3 py-1 bg-green-50 text-green-700 border border-green-200 text-xs font-bold rounded-full uppercase">Lunas</span>
                        @else
                            <span class="px-3 py-1 bg-red-50 text-red-700 border border-red-200 text-xs font-bold rounded-full uppercase">Belum Lunas</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('transactions.edit', $trx->id) }}" class="px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 text-xs font-bold rounded-lg transition-colors inline-block">
                            Ubah Status
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-10 text-center text-slate-500">Belum ada transaksi hari ini.</td> </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
