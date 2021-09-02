<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
    	'text'       ,
    	'product_id' ,
    	'user_id'    ,
    ]; 


    //создаем связь один к одному т.е одному коментарию может принадлежать один клиент .
    public function user()
    {
    	return $this->belongsTo(User::class , 'user_id' , 'id');
    }

}
