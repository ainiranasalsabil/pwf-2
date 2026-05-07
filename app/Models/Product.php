<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\User; // import User (WAJIB untuk relasi)

class Product extends Model
{
    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'user_id',      // id pemilik product
        'name',         // nama product
        'qty',          // jumlah product
        'price',        // harga product
        'kategori_id'   // relasi ke kategori
    ];

    /**
     * RELASI KE USER
     * Product dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * RELASI KE KATEGORI
     * Product memiliki satu kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}