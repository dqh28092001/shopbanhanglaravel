<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Correct import for DB
use App\Http\Requests;
use Illuminate\Support\Facades\Session; // Correct import for Session
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash; // Correct import for Hash
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function save_cart(Request $request){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();

        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $data = DB::table('tbl_product')->where('product_id', $productId)->get();
        

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }
}
