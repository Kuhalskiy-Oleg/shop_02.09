<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //указываем что данная модель отвечает за таблицу 'product_images'
    protected $table = 'categories';


    //у таблицы categories к таблице products связь один ко многим т.е одной категории  может принадлежать множество продуктов . 
    public function products()
    {
    	return $this->hasMany(Products::class , 'category_id' , 'id');
    }
}
