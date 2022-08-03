<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($cat, $product_alias) {
        $item = Product::where('alias', $product_alias)->first();
        $category = Category::where('id', $item->category_id)->first();
        $products = Product::where('category_id', $item->category_id)->WhereNot('alias', $product_alias)->orderBy('created_at')->take(4)->get();
        return view('product/show', ['item' => $item, 'category' => $category, 'products' => $products]);
    }

    public function showCategory(Request $request, $cat_alias) {
        $cat = Category::where('alias',$cat_alias)->first();

        $paginate = 4;
        $products = Product::where('category_id',$cat->id)->paginate($paginate);

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-low-high'){
                $products = Product::where('category_id',$cat->id)->orderBy('price')->paginate($paginate);
            }
            if($request->orderBy == 'price-high-low'){
                $products = Product::where('category_id',$cat->id)->orderBy('price','desc')->paginate($paginate);
            }
        }

        if($request->ajax()){
            return view('ajax.order-by',[
                'products' => $products
            ])->render();
        }

        return view('categories.index',[
            'cat' => $cat,
            'products' => $products,
        ]);



    }

}
