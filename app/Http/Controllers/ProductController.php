<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return new ProductCollection(Product::all()); // Mostrar todos los productos
        // return new ProductCollection(Product::orderBy('id', 'DESC')->paginate(5)); // ordenar DESC y paginar de 5 en 5
        // return new ProductCollection(Product::where('available', 1)->orderBy('id', 'DESC')->paginate(5)); // ordenar DESC, paginar de 5 en 5 y que este disponibles
        return new ProductCollection(Product::where('available', 1)->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->available = 0;
        $product->save();

        return [
            'message' => 'Product updated successfully',
            'product' => $product
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
