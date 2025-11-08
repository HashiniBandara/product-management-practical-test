<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    //Product list
    public function index(): View
    {
        $products = Product::where('deleted_at', 0)
            ->oldest()
            ->paginate(5);

        return view('superadmin.products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    //user product list view
      public function product_list(): View
    {
        $products = Product::where('deleted_at', 0)
            ->oldest()
            ->paginate(5);

        return view('user.products.product-list', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // Show create form
    public function create(): View
    {
        return view('superadmin.products.create');
    }

    // Store new product
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
        ]);

        return redirect()->route('superadmin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        return view('superadmin.products.show', compact('product'));
    }

    // Show edit form
    public function edit(Product $product): View
    {
        return view('superadmin.products.edit', compact('product'));
    }

    // Update a product
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
        ]);

        return redirect()->route('superadmin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    // Soft delete a product
    public function destroy(Product $product): RedirectResponse
    {
        $product->update(['deleted_at' => 1]);

        return redirect()->route('superadmin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
