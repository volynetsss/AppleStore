<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Shipping;
use App\ProductImage;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {

        return view('cart.index');
    }

    public function store(Request $request) {
        $product = Product::where('id', $request->id)->first();

        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id);

        \Cart::add([
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->new_price ? $product->new_price : $product->price,
            'alias' => $product->alias,
            'quantity' => (int) $request->qty,
            'attributes' => [
                'img' => isset($product->images[0]->img) ? $product->images[0]->img : 'no_image.jpeg'
            ]
        ]);

        return response()->json(\Cart::getContent());
    }

    public function destroy(Request $request) {
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id)->remove($request->id);
        return redirect()->route('cartIndex')->with('success', 'Successfully !');;
    }

    public function update(Request $request) {
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id)->update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]

        );
        if($request->quantity == 0) {
            \Cart::session($cart_id)->remove($request->id);
            return redirect()->route('cartIndex');
        } else {
            return redirect()->route('cartIndex');
        }
    }

    public function clear() {
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id)->clear();


        return redirect()->route('cartIndex');
    }
}
