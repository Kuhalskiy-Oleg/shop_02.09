<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkoutController()
    {
    	return view('pages.checkout');
    }
}
