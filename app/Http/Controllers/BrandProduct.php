<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Correct import for DB
use App\Http\Requests;
use Illuminate\Support\Facades\Session; // Correct import for Session
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash; // Correct import for Hash
class BrandProduct extends Controller
{
    // ngăn chặn người dùng chưa đăng nhập mà vô được bên trong 
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin_login')->send();
        }
    }
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('/Admin.add_brand_product');
    }

    public function all_brand_product()
    {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('/Admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('/Admin.admin_header')->with('admin.all_brand_product', $manager_brand_product);
    }
    // Nó lấy dữ liệu từ một yêu cầu POST bằng cách sử dụng $request
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand_product')->insert($data);
        Session::put('message', 'Thêm Thương Hiệu Sản Phẩm Thành Công');
        return Redirect::to('/add_brand_product');
    }

    // Ẩn Hiện sản phẩm trông all_products
    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Session::put('message', 'Ẩn Thương Hiệu Sản Phẩm Thành Công');
        return Redirect::to('/all_brand_product');
    }

    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Session::put('message', ' Hiển Thị Thương Hiệu Sản Phẩm Thành Công');
        return Redirect::to('/all_brand_product');
    }

    // edit brand_product
    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('/Admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('/Admin.admin_header')->with('admin.edit_brand_product', $manager_brand_product);
    }

    // update brand_product
    public function update_brand_product(Request $request, $brand_product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;

        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message', 'Cập Nhật Thương Hiệu Sản Phẩm Thành Công');
        return Redirect::to('/all_brand_product');
    }

    // delete brand_product
    public function delete_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xóa Thương Hiệu Sản Phẩm Thành Công');
        return Redirect::to('/all_brand_product');
    }

    // End Function Admin  Page

    // láy sản phẩm ra theo id của thương hiệu
    public function show_brand_home($brand_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $brand_by_id = DB::table('tbl_product')
            ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
            ->where('tbl_product.brand_id', $brand_id)->get();

        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$brand_id)->limit(1)->get();;

        return view('pages.brand.show_brand')->with('category', $cate_product)
            ->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)
            ->with('brand_name', $brand_name);
    }
}
