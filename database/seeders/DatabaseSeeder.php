<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin (Pemilik)
        User::create([
            'name' => 'Pemilik Natasya',
            'username' => 'admin',
            'password' => Hash::make('admin123'), // Password default: admin123
            'role' => 'admin',
        ]);

        // 2. Akun Kasir (Pelayanan Pelanggan)
        User::create([
            'name' => 'Kasir Utama',
            'username' => 'kasir',
            'password' => Hash::make('kasir123'), // Password default: kasir123
            'role' => 'kasir',
        ]);
    }
}
