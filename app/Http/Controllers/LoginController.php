<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function loginProcess(Request $request)
    {

    	//если пользователь уже авторизован то сразу делаем редирект на адрес котрый хотели получить либо в кабинет
		if (Auth::check()) {
			return redirect()->intended(route('kabinet'));
		}

    	$validateData = $request->validate([
    		'login'    => 'bail|required|string|max:50|min:5|alpha_dash',
    		'password' => 'bail|required|string|max:255|min:3',
    	]);


    	//если аунтефикация удалась то пользователь перейдет на ту страницу куда и хотел (до тако момента как его перекинуло на форму с рег/аунтефик) но если это не удалось то делаем редирект на страницу kabinet
    	if (Auth::attempt($validateData)) {
    		return redirect()->intended(route('kabinet'));
    	}

    	//если не удалось найти пользователя по полученным данным то
    	return redirect(route('auth.login'))->withErrors([
    		'error' => 'not user'
    	]);
    }

}
