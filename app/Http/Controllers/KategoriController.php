<?php

namespace App\Http\Controllers;

use App\Models\Kategori; // Menghubungkan controller dengan model Kategori
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // agar bisa pakai authorize()

class KategoriController extends Controller
{
    use AuthorizesRequests; // WAJIB: mengaktifkan authorize()

    /**
     * INDEX
     * Menampilkan semua data kategori + jumlah produk
     */
    public function index()
    {
        // Mengecek apakah user punya izin manage-category (biasanya admin)
        $this->authorize('manage-category');

        // Mengambil semua data kategori sekaligus menghitung jumlah produk tiap kategori
        $kategoris = Kategori::withCount('products')->get();

        // Mengirim data ke view kategori/index.blade.php
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * CREATE
     * Menampilkan halaman form tambah kategori
     */
    public function create()
    {
        // Mengecek apakah user punya izin
        $this->authorize('manage-category');

        // Menampilkan halaman form create
        return view('kategori.create');
    }

    /**
     * STORE
     * Menyimpan data kategori ke database
     */
    public function store(Request $request)
    {
        // Mengecek izin akses
        $this->authorize('manage-category');

        // Validasi input dari form
        $request->validate([
            'name' => 'required|unique:kategoris,name|max:255'
            // required = wajib diisi
            // unique = tidak boleh sama dengan data lain
            // max:255 = maksimal panjang karakter
        ]);

        // Menyimpan data kategori ke database
        Kategori::create([
            'name' => $request->name
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * SHOW (DIGUNAKAN UNTUK HALAMAN KONFIRMASI DELETE)
     */
    public function show(Kategori $kategori)
    {
        // Mengecek izin akses
        $this->authorize('manage-category');

        // Mengirim data ke halaman konfirmasi delete
        return view('kategori.delete', compact('kategori'));
    }

    /**
     * EDIT
     * Menampilkan form edit kategori
     */
    public function edit(Kategori $kategori)
    {
        // Mengecek izin akses
        $this->authorize('manage-category');

        // Mengirim data kategori ke halaman edit
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * UPDATE
     * Mengupdate data kategori
     */
    public function update(Request $request, Kategori $kategori)
    {
        // Mengecek izin akses
        $this->authorize('manage-category');

        // Validasi input (tidak boleh kosong dan tidak boleh duplikat kecuali data sendiri)
        $request->validate([
            'name' => 'required|unique:kategoris,name,' . $kategori->id . '|max:255'
            // unique di sini mengabaikan id kategori yang sedang diedit
        ]);

        // Mengupdate data kategori di database
        $kategori->update([
            'name' => $request->name
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * DESTROY
     * Menghapus kategori
     */
    public function destroy(Kategori $kategori)
    {
        // Mengecek izin akses
        $this->authorize('manage-category');

        // Menghapus data kategori dari database
        $kategori->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}