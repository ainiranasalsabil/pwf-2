<?php

namespace App\Http\Requests; // Menentukan lokasi file ini di folder Laravel

use Illuminate\Foundation\Http\FormRequest; // Menggunakan class FormRequest untuk validasi

class UpdateProductRequest extends FormRequest // Class ini dipakai untuk validasi saat update product
{
    /**
     * Mengecek apakah user boleh melakukan request ini
     */
    public function authorize(): bool
    {
        return true; // semua user boleh, nanti dibatasi di Policy
    }

    /**
     * Aturan validasi untuk setiap input dari form
     */
    public function rules(): array
    {
        return [

            // FIELD: name (nama produk)
            'name' => 'required|string|max:255',
            // wajib diisi, harus teks, maksimal 255 karakter

            // FIELD: kategori_id (kategori produk)
            'kategori_id' => 'required|exists:kategoris,id',
            // wajib dipilih
            // exists memastikan kategori benar-benar ada di database

            // FIELD: qty (jumlah produk)
            'qty' => 'required|integer|min:1',
            // wajib diisi, harus angka bulat, minimal 1

            // FIELD: price (harga produk)
            'price' => 'required|numeric|min:0',
            // wajib diisi, harus angka, tidak boleh negatif

        ];
    }

    /**
     * Pesan error custom (biar lebih jelas ke user)
     */
    public function messages(): array
    {
        return [

            // ERROR untuk name
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            // ERROR untuk qty
            'qty.required' => 'Jumlah produk wajib diisi.',
            'qty.integer' => 'Jumlah produk harus berupa angka bulat.',
            'qty.min' => 'Jumlah produk minimal 1.',

            // ERROR untuk price
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',

            // ERROR untuk kategori
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            // muncul jika id tidak ditemukan di database
        ];
    }
}