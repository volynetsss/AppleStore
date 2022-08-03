<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index() {
        if(!isset($_COOKIE['cart_id'])) {
            setcookie('cart_id', uniqid());
        }
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id);

        $products = Product::whereNot('new_price', null)->orderBy('created_at')->take(8)->get();
        $galleries = Gallery::orderBy('created_at')->get();
        $icons = Feature::orderBy('created_at')->get();
        return view('home/index', ['products' => $products, 'galleries' => $galleries, 'icons' => $icons]);
    }


}
