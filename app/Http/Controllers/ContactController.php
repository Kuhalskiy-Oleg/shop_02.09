<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function contactForm(ContactFormRequest $request)
    {
        //отправляем данные в ContactFormMail на email 'Kuhalskiy96@yandex.ru'
    	Mail::to('Kuhalskiy96@yandex.ru')->send(new ContactFormMail($request->validated()));

    	//перезагружаем страницу
    	return redirect(route('contact'));
    }
}
