<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller {

    public const DEFAULT_QUANTITY = 1;
    public function index() {
        return json_decode(Cookie::get('cart')) ?? [];
    }
    public function insert(Request $request) {

        $cart = Cookie::get('cart') ? json_decode(Cookie::get('cart')) : [];

        $cart = (array) $cart;

        if (!array_key_exists($request->id, $cart)) {
            $cart[$request->id] = self::DEFAULT_QUANTITY;
        }


        Cookie::queue('cart', json_encode($cart), 240);
    }

    public function updateQuantity(Request $request) {

        $cart = Cookie::get('cart') ? json_decode(Cookie::get('cart')) : [];

        $cart = (array) $cart;

        $cart[$request->id] = $request->quantity;
        Cookie::queue('cart', json_encode($cart), 240);
    }

    public function removeItem(Request $request) {
        $cart = Cookie::get('cart') ? json_decode(Cookie::get('cart')) : [];

        $cart = (array) $cart;

        unset($cart[$request->id]);
        Cookie::queue('cart', json_encode($cart), 240);
    }
    public function deleteCart() {
        $cookie = Cookie::forget('cart');
        return Redirect::route('cart')->withCookie($cookie);
    }
}
