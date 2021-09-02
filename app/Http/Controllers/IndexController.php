<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class IndexController extends Controller
{
    public function index()
    {	
    	//ищем самые новые товары в кол-ве 8 шт
    	$products = Products::orderBy('created_at','asc')->take(8)->get();

    	return view('home.index',compact('products'));
    }
}
