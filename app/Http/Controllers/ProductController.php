<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->where('status', true)
            ->orderBy('order')
            ->get();

        return view('products.index')
            ->with(['products' => $products]);
    }

    public function create()
    {
        //
    }

    public function store(StoreProductRequest $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        if (!empty($request->products)) {
            foreach ($request->products as $key => $product) {
                $key = $key + 1;
                Product::query()->where('id', $product)
                    ->update([
                        'status' => 1,
                        'order' => $key
                    ]);
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function destroy(Product $product)
    {
        //
    }
}
