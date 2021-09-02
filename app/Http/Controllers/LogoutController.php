<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
    	//Это удалит информацию аутентификации из сеанса пользователя
    	Auth::logout();
    	return redirect(route('index'));
    }
}
