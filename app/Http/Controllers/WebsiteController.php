<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        return view('website.home');
    }
    public function about(){
        return view('website.about');
    }
    public function contact(){
        return view('website.contact');
    }
    public function shop(){
        return view('website.product');
    }
    public function productDetails(){
        return view('website.product-details');
    }
    public function checkout(){
        return view('website.checkout');
    }
    public function cart(){
        return view('website.cart');
    }
}
