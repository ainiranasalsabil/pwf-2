<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductApiController extends Controller
{
    /**
     * GET ALL PRODUCT
     */
    public function index()
    {
        $products = Product::with('kategori', 'user')->latest()->get();

        return response()->json([
            'message' => 'Data product berhasil diambil',
            'data' => $products
        ], 200);
    }

    /**
     * STORE PRODUCT
     */
    public function store(StoreProductRequest $request)
    {
        try {

            $validated = $request->validated();

            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);

        } catch (\Throwable $e) {

            Log::error($e->getMessage());

            return response()->json([
                'message' => 'Gagal tambah product'
            ], 500);
        }
    }

    /**
     * SHOW PRODUCT
     */
    public function show(int $id)
    {
        $product = Product::with('kategori', 'user')->find($id);

        if (!$product) {

            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Product ditemukan',
            'data' => $product
        ], 200);
    }

    /**
     * UPDATE PRODUCT
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        $product = Product::find($id);

        if (!$product) {

            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        $product->update($request->validated());

        return response()->json([
            'message' => 'Product berhasil diupdate',
            'data' => $product
        ], 200);
    }

    /**
     * DELETE PRODUCT
     */
    public function destroy(int $id)
    {
        $product = Product::find($id);

        if (!$product) {

            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product berhasil dihapus'
        ], 200);
    }
}