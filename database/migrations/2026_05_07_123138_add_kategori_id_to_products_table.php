<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration (menambah kolom baru)
     */
    public function up(): void
    {
        // Mengubah tabel products (menambahkan kolom kategori_id)
        Schema::table('products', function (Blueprint $table) {

            // Menambahkan kolom kategori_id sebagai foreign key
            // foreignId = tipe unsigned big integer
            $table->foreignId('kategori_id')

                  // Kolom boleh kosong (untuk menghindari error data lama)
                  ->nullable()

                  // Menghubungkan ke tabel "kategoris" kolom id
                  ->constrained('kategoris')

                  // Jika kategori dihapus, product ikut terhapus
                  ->cascadeOnDelete();
        });
    }

    /**
     * Rollback migration (menghapus perubahan)
     */
    public function down(): void
    {
        // Menghapus kolom kategori_id dari tabel products
        Schema::table('products', function (Blueprint $table) {

            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['kategori_id']);

            // Hapus kolom kategori_id
            $table->dropColumn('kategori_id');
        });
    }
};