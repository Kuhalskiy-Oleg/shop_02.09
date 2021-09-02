<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotFormRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ForgotFormMail;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ForgotController extends Controller
{
    //метод для отправки письма клиенту с новым паролем
    public function forgot_process(ForgotFormRequest $request)
    {
        //ищем нужного клиента
    	$user = User::where('email', $request->validated()['email'])->first();
    	//дополнительную проверку на инициализацию(нашелся пользователь с таким email или нет) переменной user можно не делать т.к эта проверка есть в ForgotFormRequest при валидации exists:users,email

    	//cоздаем новый пароль т.к старый уже не расхешировать(но это не точно)
    	$password = uniqid();

    	//обновляем таблицу у выбранного юзера и заносив в нее новый парол
    	$user->password = $password;

    	//если бы у нас в модели небыло прописано шифрование поля password то мы бы шифровали его тут
    	//$user->password = bcrypt($password);

    	//cохраняем изменения
    	$user->save();
		
        //отправляем данные в ForgotFormMail на email выбранного юзера(to($user))
    	Mail::to($user)->send(new ForgotFormMail([
    		'password' => $password,
    		'email'    => $user->email
    	]));

        //перекидываем клиента на страницу с формой входа
    	return redirect(route('auth.login'));
    }
}
