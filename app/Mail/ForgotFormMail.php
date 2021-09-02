<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotFormMail extends Mailable
{
    use Queueable, SerializesModels;

    //эти переменные будем наполнять пришедшими данными из контроллера
    protected $password;
    protected $email;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //dd($data);
        $this->password = $data['password'];
        $this->email = $data['email'];
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //данные отправляются на страницу forgotForm и эта страница и отправится получателю письма
        return $this->view('emails.forgotForm')->with([
            'password' => $this->password, 
            'email' => $this->email, 

        ]);
    }
}
