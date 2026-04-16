<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    // ✅ STORE (VALIDATION)
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        Product::create($validated);

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

    // ✅ EDIT (PAKAI POLICY)
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $this->authorize('update', $product);

        return view('product.edit', compact('product'));
    }

    // ✅ UPDATE (VALIDATION + POLICY)
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->authorize('update', $product);

        $product->update($request->validated());

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    // ✅ DELETE (POLICY)
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully.');
    }
}