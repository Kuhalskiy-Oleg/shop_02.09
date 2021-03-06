<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CommentsForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        //проверка на аунтифицированного пользователя, т.е коментарии может писать только аунтифицированный пользователь (без этой проверки будет 403 ошибка)
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [     
            // РЕГУЛЯРКА 
            // ^ - начало строки
            // ["\'a-zа-яё\d]{1} - строка может начинаться с букв латинского или русского языка (a-zа-яё) или цифры (\d) или символов('"). Один из этих символов должен обязательно встречаться {1} раз.    
            // [-!."\',?a-zа-яё\d\s]* - то же самое, что в предыдущем случае, но добавляем еще любой пробельный символ (пробел, перевод строки, табуляция) и знаки ! ? ' " , - . Один их этих символов может встречаться произвольное число раз, 0 или больше, это и означает знак *
            // ["\'!.?a-zа-яё\d]{1} - какой символ должен находиться непосредственно перед концом строки.
            // $ - собственно, конец строки.
            // u - возможность писать русские буквы
            // i - регистро независимый
 
            'text' =>   [ 
                            'bail'    ,
                            'required',
                            'string'  ,
                            'max:1500',
                            'min:10'  ,
                            'regex:/^["\'a-zа-яё\d]{1}[-!."\',?a-zа-яё\d\s]*["\'!.?a-zа-яё\d]{1}$/ui'            
                        ],

            'user_id' => 'bail|required|exists:users,id',//user_id передался из метода prepareForValidation()
        ];
    }

    // prepareForValidation() - функция которая будет вызвана по умолчанию до функции rules() и в ней мы можем добавить данные к данным которые пришли из формы, чтобы не светить их в самой форме а сделать это добавление скрытным
    protected function prepareForValidation()
    {
        //добавляем к данным из формы пару ключ-значение с id клиента который отправил этот коментарий
        $this->merge([
            'user_id' => auth()->id()
        ]);
    }
}
