<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Correct import for DB
use App\Http\Requests;
use Illuminate\Support\Facades\Session; // Correct import for Session
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash; // Correct import for Hash
class ProductController extends Controller
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
    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();

        return view('/Admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderBy('tbl_product.product_id','desc')->get();
        $manager_product = view('/Admin.all_product')->with('all_product', $all_product);
        return view('/Admin.admin_header')->with('admin.all_product', $manager_product);
    }
    // Nó lấy dữ liệu từ một yêu cầu POST bằng cách sử dụng $request
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;

        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            //  chia chuỗi thành một mảng bằng cách sử dụng dấu chấm (.) làm dấu phân cách .. 
            // vd : example.jpg" thành "example" và "jpg".
            $name_image = current(explode('.',$get_name_image));
            //getClientOriginalExtension nó sẽ lấy cái đuôi mở rộng , vd: jpg,png....
            $new_image = $name_image.'_'.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm Sản Phẩm Thành Công');
            return Redirect::to('add_product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm Sản Phẩm Thành Công');
        return Redirect::to('/add_product');
    }

    // Ẩn Hiện sản phẩm trông all_products
    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Ẩn Sản Phẩm Thành Công');
        return Redirect::to('/all_product');
    }
    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', ' Hiển Thị Sản Phẩm Thành Công');
        return Redirect::to('/all_product');
    }
    // END Ẩn Hiện sản phẩm trông all_products


    // edit brand_product
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('/Admin.edit_product')->with('edit_product', $edit_product)
        ->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product);
        return view('/Admin.admin_header')->with('admin.edit_product', $manager_product);
    }

    // update brand_product
    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');

        if ($get_image) {   
            $get_name_image = $get_image->getClientOriginalName();
            //  chia chuỗi thành một mảng bằng cách sử dụng dấu chấm (.) làm dấu phân cách .. 
            // vd : example.jpg" thành "example" và "jpg".
            $name_image = current(explode('.',$get_name_image));
            //getClientOriginalExtension nó sẽ lấy cái đuôi mở rộng , vd: jpg,png....
            $new_image = $name_image.'_'.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message', 'Cập Nhật Sản Phẩm Thành Công');
            return Redirect::to('all_product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập Nhật Sản Phẩm Thành Công');
        return Redirect::to('/all_product');
    }

    // delete brand_product
    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xóa Sản Phẩm Thành Công');
        return Redirect::to('/all_product');
    }

    // And Admin Page

    // Detail Product
    public function detail_product($product_id){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();

        $detail_product =  DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();


        return view('pages.sanpham.show_detail')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('detail_product',$detail_product) ;
    }
}
