<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Users (Mengelola Admin & Kasir)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'kasir']); // Hak akses pengguna
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Tabel Customers (Data Pelanggan Laundry)
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->unique(); // Contoh: PLG-001
            $table->string('name');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        // 3. Tabel Services (Jenis Jasa/Layanan Laundry)
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name'); // Contoh: Cuci Kering Setrika, Bed Cover
            $table->enum('unit', ['kg', 'satuan']); // Satuan berat atau per biji
            $table->decimal('price_per_unit', 10, 2); // Tarif harga
            $table->integer('estimated_days'); // Estimasi pengerjaan (hari)
            $table->timestamps();
        });

        // 4. Tabel Transactions (Header Transaksi Penjualan)
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique(); // Otomatis terbuat (Contoh: INV-20260614-0001)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kasir yang melayani
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Pelanggan
            $table->date('transaction_date');
            $table->date('pickup_date')->nullable();
            $table->decimal('total_price', 10, 2)->default(0); // Total tarif otomatis kalkulasi
            $table->decimal('amount_paid', 10, 2); // Nominal uang yang diterima
            $table->decimal('amount_return', 10, 2); // Uang kembalian
            $table->enum('status', ['proses', 'selesai', 'diambil'])->default('proses'); // Status pengerjaan
            $table->enum('payment_status', ['lunas', 'belum_lunas'])->default('belum_lunas');
            $table->timestamps();
        });

        // 5. Tabel Transaction Details (Item yang Dicuci)
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->double('quantity'); // Berat (kg) atau jumlah satuan
            $table->decimal('price', 10, 2); // Harga saat transaksi berjalan
            $table->decimal('subtotal', 10, 2); // quantity * price
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('services');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('users');
    }
};
