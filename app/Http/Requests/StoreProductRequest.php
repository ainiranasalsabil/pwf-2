<?php

namespace App\Http\Requests; // namespace lokasi file request di Laravel

use Illuminate\Foundation\Http\FormRequest; // class bawaan Laravel untuk validasi request

class StoreProductRequest extends FormRequest // membuat class request baru
{
    /**
     * Mengecek apakah user boleh akses request ini
     */
    public function authorize(): bool
    {
        return true; // semua user boleh akses
    }

    /**
     * RULE VALIDASI
     * Berisi aturan validasi input dari form
     */
    public function rules(): array
    {
        return [

            // FIELD NAME (nama produk)
            'name' => 'required|string|max:255',
            // wajib diisi, harus teks, maksimal 255 karakter

            // FIELD KATEGORI
            'kategori_id' => 'required|exists:kategoris,id',
            // wajib dipilih
            // exists = memastikan id kategori benar-benar ada di tabel kategoris

            // FIELD QTY (jumlah produk)
            'qty' => 'required|integer|min:1',
            // wajib diisi, harus angka bulat, minimal 1

            // FIELD PRICE (harga)
            'price' => 'required|numeric|min:0',
            // wajib diisi, harus angka, tidak boleh negatif

        ];
    }

    /**
     * PESAN ERROR CUSTOM
     */
    public function messages(): array
    {
        return [

            // NAME
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            // QTY
            'qty.required' => 'Jumlah (kuantitas) produk wajib diisi.',
            'qty.integer' => 'Jumlah produk harus berupa angka bulat.',
            'qty.min' => 'Jumlah produk minimal 1.',

            // PRICE
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',

            // KATEGORI
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            // muncul jika user kirim kategori yang tidak ada
        ];
    }
}