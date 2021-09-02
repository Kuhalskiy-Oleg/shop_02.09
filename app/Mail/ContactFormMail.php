<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    //cоздаем переменную которую наполним массивом отвадидированных данных которые передадутся в конструктор из контроллера ContactController из метода contactForm где мы используем фасад Mail и его метод send где мы указали класс ContactFormMail и передали в его параметры отвадидированные данные которые попали в метод конструктор
    protected $formData = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($validatedDataFromContactForm)
    {
        //в этот метод конструктор попадают любые данные которые отправляются в класс ContactFormMail
        //обращаемся к свойству класса $formData(она же пустая переменная) и наполняем его данными пришедшими в конструктор
        $this->formData = $validatedDataFromContactForm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //данные отправляются на страницу contactForm и эта страница и отправится получателю письма
        return $this->view('emails.contactForm')->with($this->formData);
    }
}
