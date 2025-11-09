<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    // GET /api/products
    public function index()
    {
        $products = Product::where('deleted_at', 0)->get();
        return response()->json($products);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::where('id', $id)->where('deleted_at', 0)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    // PUT /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->where('deleted_at', 0)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($request->all());

        return response()->json($product);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $product = Product::where('id', $id)->where('deleted_at', 0)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Soft delete using your existing integer column
        $product->update(['deleted_at' => 1]);

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
