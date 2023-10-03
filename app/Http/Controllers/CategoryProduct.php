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
    // ngăn chặn người dùng chưa đăng nhập mà vô được bên trong 
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin_login')->send();

        }
    }
    public function add_category_product()
    {
        $this->AuthLogin();
        return view('/Admin.add_category_product');

    }

    public function all_category_product()
    {
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('/Admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('/Admin.admin_header')->with('admin.all_category_product',$manager_category_product);

    }

    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data ['category_name'] = $request->category_product_name;
        $data ['category_desc'] = $request->category_product_desc;
        $data ['category_status'] = $request->category_product_status;
        
        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('/add_category_product');

    }

    // Ẩn Hiện sản phẩm trông all_products
    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session::put('message', 'Ẩn Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('/all_category_product');
    }
    
    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', ' Hiển Thị Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('/all_category_product');
    }

    // edit category_product
    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('/Admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('/Admin.admin_header')->with('admin.edit_category_product',$manager_category_product);
    }

    // update category_product
    public function update_category_product(Request $request,$category_product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data ['category_name'] = $request->category_product_name;
        $data ['category_desc'] = $request->category_product_desc;
        
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message', 'Cập Nhật Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('/all_category_product');
    }

    // delete category_product
    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Xóa Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('/all_category_product');
    }
    
    // End Function Admin  Page

    // láy sản phẩm ra theo id của danh mục 
    public function show_category_home($category_id){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }


}
