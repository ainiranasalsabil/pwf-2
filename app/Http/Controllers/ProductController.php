<?php

namespace App\Http\Controllers;

use App\Models\Product; // Model Product
use App\Models\Kategori; // Model Kategori
use Illuminate\Support\Facades\Auth; // Untuk ambil user login
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Authorization
use App\Http\Requests\StoreProductRequest; // Validasi store
use App\Http\Requests\UpdateProductRequest; // Validasi update

class ProductController extends Controller
{
    use AuthorizesRequests;

    /**
     * ================= INDEX =================
     * Menampilkan semua data product + kategori
     */
    public function index()
    {
        // Ambil semua product + relasi kategori
        $products = Product::with('kategori')->latest()->get();

        // Kirim ke view product.index
        return view('product.index', compact('products'));
    }

    /**
     * ================= CREATE =================
     * Menampilkan form tambah product
     */
    public function create()
    {
        // Ambil semua kategori (untuk dropdown)
        $kategoris = Kategori::all();

        // Kirim ke view
        return view('product.create', compact('kategoris'));
    }

    /**
     * ================= STORE =================
     * Menyimpan data product baru
     */
    public function store(StoreProductRequest $request)
    {
        // Ambil data hasil validasi
        $validated = $request->validated();

        // Tambahkan user_id dari user login
        $validated['user_id'] = Auth::id();

        // Simpan ke database
        Product::create([
            'name' => $validated['name'], // nama produk
            'kategori_id' => $validated['kategori_id'], // relasi kategori
            'qty' => $validated['qty'], // jumlah (HARUS qty, bukan quantity)
            'price' => $validated['price'], // harga
            'user_id' => $validated['user_id'], // pemilik
        ]);

        // Redirect ke halaman index + pesan sukses
        return redirect()->route('product.index')
            ->with('success', 'Product berhasil ditambahkan');
    }

    /**
     * ================= SHOW =================
     * Menampilkan detail product
     */
    public function show(Product $product)
    {
        // Load relasi kategori
        $product->load('kategori');

        // Kirim ke view
        return view('product.view', compact('product'));
    }

    /**
     * ================= EDIT =================
     * Menampilkan form edit product
     */
    public function edit(Product $product)
    {
        // Ambil semua kategori
        $kategoris = Kategori::all();

        // Cek hak akses user (policy)
        $this->authorize('update', $product);

        // Kirim data ke view
        return view('product.edit', compact('product', 'kategoris'));
    }

    /**
     * ================= UPDATE =================
     * Mengupdate data product
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Cek hak akses
        $this->authorize('update', $product);

        // Update data menggunakan hasil validasi
        $product->update([
            'name' => $request->validated()['name'],
            'kategori_id' => $request->validated()['kategori_id'],
            'qty' => $request->validated()['qty'], // HARUS qty
            'price' => $request->validated()['price'],
        ]);

        // Redirect + pesan sukses
        return redirect()->route('product.index')
            ->with('success', 'Product berhasil diupdate');
    }

    /**
     * ================= DESTROY =================
     * Menghapus product
     */
    public function destroy(Product $product)
    {
        // Cek hak akses user
        $this->authorize('delete', $product);

        // Hapus data dari database
        $product->delete();

        // Redirect + pesan sukses
        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }
}