<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Images;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $resource = null;

        if (isset($request->ids)) {
            $resource = Product::find($request->ids);
        }
        else { 
            $resource = Product::all();
        }
        if ($request->status == "A") {
            $products = ProductResource::collection( $resource->where('status', '=', 'A'));
        } else {
            $products = ProductResource::collection( $resource);
        }
        
        return $request->random ? $products->shuffle() : $products;
    }

    public function indexActives() {
        return ProductResource::collection(Product::all()->where('status', '=', 'A'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) {
        $product = Product::create($request->validated());
        
        if ($request->file('images')->isValid()) {
            $image = new Image();
            $image->products_id = $product->id;
            $image->path = $request->file('images')->store('', 'images');
            $image->save();
        }
      
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product) {
        $product->update($request->validated());
        return new ProductResource($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        Image::whereIn('products_id', $request->ids)->delete();
        Product::destroy($request->ids);
        return response()->noContent();
    }
}

