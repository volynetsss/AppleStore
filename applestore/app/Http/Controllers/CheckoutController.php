<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout() {
        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id);
        return view('checkout.checkout');
    }

    public function placeorder(Request $request) {
        $order = new Orders();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        $order->city = $request->input('city');
        $order->address = $request->input('address');
        $order->tracking_no = 'apple_store'.rand(1111,9999);
        $order->save();

        $order->id;

        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id);
        foreach(\Cart::getContent() as $item){
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' =>$item->id,
                'qty' => $item->quantity,
                'price'=>$item->price * $item->quantity
            ]);
        }



        \Cart::clear();

        return redirect('/cart/checkout')->with('success', 'Успішно! Код вашого замовлення - '.$order->tracking_no);
    }


}
