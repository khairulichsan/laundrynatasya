<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // 1. Menampilkan Semua Antrean Transaksi
    public function index()
    {
        // Mengambil transaksi dengan relasi bertingkat (Eager Loading): customer dan detail service-nya
        $transactions = Transaction::with(['customer', 'details.service'])->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    // 2. Menampilkan Form Transaksi Baru
    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        return view('transactions.create', compact('customers', 'services'));
    }

    // 3. Menyimpan Transaksi ke Database (Master & Detail)
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'service_id' => 'required',
            'qty' => 'required|numeric|min:0.1',
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $service = Service::findOrFail($request->service_id);

        $pricePerUnit = $service->price_per_unit;
        $subtotal = $pricePerUnit * $request->qty;
        $totalPrice = $subtotal;

        if ($customer->is_member) {
            $diskon = $totalPrice * 0.10;
            $totalPrice = $totalPrice - $diskon;
        }

        // SIMPAN KE TABEL MASTER (transactions)
        $transaction = Transaction::create([
            'invoice_number'   => 'INV-' . strtoupper(Str::random(6)),
            'user_id'          => Auth::id(),
            'customer_id'      => $request->customer_id,
            'transaction_date' => now(),
            'pickup_date'      => now()->addDays($service->estimated_days ?? 2),
            'total_price'      => $totalPrice,
            'amount_paid'      => 0,
            'amount_return'    => 0,
            'status'           => 1,
            'payment_status'   => 1,
        ]);

        // SIMPAN KE TABEL DETAIL (transaction_details)
        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'service_id'     => $request->service_id,
            'quantity'       => $request->qty,
            'price'          => $pricePerUnit,
            'subtotal'       => $totalPrice,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat!');
    }

    // 4. Menampilkan Form Edit Status
    public function edit($id)
    {
        // Mengambil data transaksi beserta detailnya
        $transaction = Transaction::with(['customer', 'details.service'])->findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    // 5. Menyimpan Perubahan Status ke Database
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'payment_status' => 'required',
        ]);

        $transaction = Transaction::findOrFail($id);

        // Logika Otomatis: Jika kasir mengubah status jadi "lunas",
        // maka jumlah bayar (amount_paid) otomatis disamakan dengan total harga.
        $amountPaid = $transaction->amount_paid;
        if ($request->payment_status == 'lunas') {
            $amountPaid = $transaction->total_price;
        }

        $transaction->update([
            'status'         => $request->status,
            'payment_status' => $request->payment_status,
            'amount_paid'    => $amountPaid,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Status transaksi berhasil diperbarui!');
    }
}
