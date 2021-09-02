<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RegistrationController extends Controller
{
    //метод принимает данные из формы и делает по ним выводы добавлять пользователя в бд или выдать какую либо ошибку
    public function save(Request $request)
    {

    	//если пользователь уже авторизован то сразу делаем редирект на приватную страницу
		if (Auth::check()) {
			return redirect(route('kabinet'));
		}

    	$validateData = $request->validate([
    		'name'     => 'bail|required|string|max:100|min:2|alpha',
    		'surname'  => 'bail|required|string|max:150|min:2|alpha',
    		'login'    => 'bail|required|string|max:50|min:5|unique:users|alpha_dash',
    		'email'    => 'bail|required|string|email',
    		'password' => 'bail|required|string|max:20|min:3|confirmed',
    	]);

    	//выводим собственную ошибку на страницу регистрации
    	//вместо этой записи можно использовать unique:users в методе validate
    	//exists - проверяет существует ли такая запись в таблице
    	if (User::where('email', $validateData['email'])->exists()) {
    		return redirect(route('auth.registration'))->withErrors([
    			//'email' передастся на страницу (с формой регистрации) в переменную $error и значение будет доступно в переменной $message
    			'email' => 'Такой email уже зарегистрирован'
    		]);
    	}


    	//validateData - находятся отвалидированные данные из формы (в виде массива)
    	//добавляем пользователя в таблицу users с помошью метода create
    	$user = User::create($validateData);

    	//если пользователь добавлен успешно то мы сразу его аунтифицируем при помощи методa login и делаем редирект на страницу kabinet
    	if ($user) {

    		//используя фасад Auth
    		Auth::login($user);

    		return redirect(route('kabinet'));
    	}


    	//выводим собственную ошибку на страницу регистрации
    	return redirect(route('auth.registration'))->withErrors([
    		'formError' => 'Произошла ошибка при сохранении пользователя'
    	]);

    }
}
