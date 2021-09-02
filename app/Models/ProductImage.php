<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    //указываем что данная модель отвечает за таблицу 'product_images'
    protected $table = 'product_images';

}
