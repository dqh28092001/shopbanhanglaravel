<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Correct import for DB
use App\Http\Requests;
use Illuminate\Support\Facades\Session; // Correct import for Session
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash; // Correct import for Hash
session_start();

class CategoryProduct extends Controller
{
    public function add_category_product()
    {
        return view('/Admin.add_category_product');

    }

    public function all_category_product()
    {
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('/Admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('/Admin.admin_header')->with('admin.all_category_product',$manager_category_product);

    }

    public function save_category_product(Request $request)
    {
        $data = array();
        $data ['category_name'] = $request->category_product_name;
        $data ['category_desc'] = $request->category_product_desc;
        $data ['category_status'] = $request->category_product_status;
        
        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('/add_category_product');

    }
}
