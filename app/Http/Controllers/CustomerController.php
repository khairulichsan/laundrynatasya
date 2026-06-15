<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // 1. Menampilkan Halaman & Form Pelanggan
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    // 2. Menyimpan Data Pelanggan Baru (Bisa diakses Admin & Kasir)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Membuat kode pelanggan otomatis
        $latestCustomer = Customer::latest()->first();
        $nextNumber = $latestCustomer ? ($latestCustomer->id + 1) : 1;
        $customerCode = 'CUST-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Customer::create([
            'customer_code' => $customerCode,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_member' => $request->has('is_member'), // Jika dicentang nilainya true, jika tidak false
        ]);

        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    // 3. Menghapus Data Pelanggan (KHUSUS ADMIN)
    public function destroy($id)
    {
        // Proteksi tingkat sistem: Jika bukan admin, tolak akses hapus
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('customers.index')->withErrors('Akses ditolak! Hanya Admin yang boleh menghapus data pelanggan.');
        }

        Customer::destroy($id);
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil dihapus!');
    }
}
