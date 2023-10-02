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
        Session::put('message', 'Không Kích Hoạt Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('/all_category_product');
    }
    
    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', ' Kích Hoạt Danh Mục Sản Phẩm Thành Công');
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
    
}
