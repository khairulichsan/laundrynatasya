<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    // 1. DASHBOARD KASIR
    public function dashboard()
    {
        $orders = Order::with('customer')->orderBy('created_at', 'desc')->get();
        $customers = Customer::all();
        $services = Service::all();
        return view('pos.dashboard', compact('orders', 'customers', 'services'));
    }

    public function storeOrder(Request $request) {
        // ... (Tetap gunakan logika storeOrder dari langkah sebelumnya) ...
    }

    // 2. MANAJEMEN PELANGGAN
    public function customers()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();
        return view('pos.customers', compact('customers'));
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers,phone',
            'address' => 'required|string',
        ]);

        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'joined_date' => now(),
            'points' => 0,
            'total_orders' => 0
        ]);

        return redirect()->back()->with('success', 'Pelanggan baru berhasil ditambahkan!');
    }

    // 3. MANAJEMEN LAYANAN & PAKET
    public function services()
    {
        $services = Service::orderBy('category', 'asc')->get();
        return view('pos.services', compact('services'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:kiloan,satuan,dry_clean,paket',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'estimate_days' => 'required|integer|min:1',
        ]);

        Service::create($request->all());

        return redirect()->back()->with('success', 'Layanan/Paket baru berhasil didaftarkan!');
    }
}
