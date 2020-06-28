<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::check()) {
                $auth_user = Auth::user();
            }
            return view('welcome', compact('auth_user'));
        } else {
            $auth_user = null;
            return view('welcome', compact('auth_user'));
            // return redirect('/login');
        }
    }
}
