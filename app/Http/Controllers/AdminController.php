<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Correct import for DB
use App\Http\Requests;
use Illuminate\Support\Facades\Session; // Correct import for Session
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash; // Correct import for Hash


session_start();

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.admin_login');
    }
    public function show_dashboard()
    {
        return view('Admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);

            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Mật khẩu hoặc tài khoản bị sai.Xin vui lòng nhập lại');
            return Redirect::to('/admin_login');
        }
    }

    public function logout()
    {
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin_login');

    }
}
