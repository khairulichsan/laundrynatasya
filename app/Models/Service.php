<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // 1. Izinkan kolom sesuai struktur asli database
    protected $fillable = ['service_name', 'unit', 'price_per_unit', 'estimated_days'];

    // 2. Alias agar view lama ($service->name) tetap jalan
    public function getNameAttribute()
    {
        return $this->service_name;
    }

    // 3. Alias agar view lama ($service->price) tetap jalan
    public function getPriceAttribute()
    {
        return $this->price_per_unit;
    }
}
