<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    
    public function index() {
        return Cookie::get('cart');

    }
    public function insert(Request $request) {
        $value = $request->id;
        Cookie::queue('cart',$request->id, 240);

    }

    public function delete() {
        Cookie::forget('cart');
    }
}
