<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; // Memanggil model Service

class ServiceController extends Controller
{
    // 1. Menampilkan halaman daftar layanan
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // 2. Menyimpan data layanan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        // Menyimpan ke database dengan nama kolom yang sangat presisi
        Service::create([
            'service_name' => $request->name,
            'price_per_unit' => $request->price,
            'unit' => $request->unit,
            'estimated_days' => 1, // Kita beri nilai default 1 hari pengerjaan
        ]);

        return redirect()->route('services.index')->with('success', 'Layanan jasa berhasil ditambahkan!');
    }

    // 3. Menghapus data layanan
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->route('services.index')->with('success', 'Layanan jasa berhasil dihapus!');
    }
}
