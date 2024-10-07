<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(Request $request){


        $adminEmail = $request->session()->get('email'); // Get the session value
        // You can also get the cookie value if needed
        $cookieEmail = $request->cookie('email');
        return view('admin.dashboard', compact('adminEmail', 'cookieEmail'));
    }

}
