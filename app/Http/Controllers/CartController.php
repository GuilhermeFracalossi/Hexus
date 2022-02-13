<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    
    public function index() {
        return json_decode(Cookie::get('cart'));

    }
    public function insert(Request $request) {
        
        $cart = Cookie::get('cart') ? json_decode(Cookie::get('cart')) : [];

        $cart = (array) $cart;
        $cart[] = $request->id;

        $cart = array_unique($cart);

        Cookie::queue('cart',json_encode($cart), 240);

    }

    public function delete() {
        Cookie::forget('cart');
    }
}
