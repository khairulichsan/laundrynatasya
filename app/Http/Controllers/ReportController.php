<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function index()
    {
        // Menghitung ringkasan pendapatan
        $totalPendapatan = Transaction::sum('total_price');
        $totalTransaksi = Transaction::count();

        // Mengambil histori transaksi terbaru untuk tabel laporan
        $laporanTransaksi = Transaction::with(['customer', 'service'])->latest()->get();

        return view('reports.index', compact('totalPendapatan', 'totalTransaksi', 'laporanTransaksi'));
    }
}
