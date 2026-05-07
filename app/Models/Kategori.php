<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // Menentukan nama tabel karena tidak mengikuti default Laravel (kategoris, bukan kategoris -> categories)
    protected $table = 'kategoris';

    // Menentukan kolom yang boleh diisi (mass assignment)
    protected $fillable = ['name'];

    // Relasi: satu kategori memiliki banyak produk
    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_id');
    }
}