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

        if ($request->get('ids')  != null) {
            
            $resource = Product::find($request->get('ids'));
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


        $image = Image::where('products_id', $product->id);
        if ($image->exists()) {
            $product->images = $image->first()->path;
        } else {
            $product->images = null;
        }
        return new ProductResource($product);;
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

