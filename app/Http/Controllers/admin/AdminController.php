<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $auth_user = Auth::guard('admin')->user();
        // dd($auth_user);

        return view('vendor.multiauth.admin.home', compact('auth_user'));
    }
}
