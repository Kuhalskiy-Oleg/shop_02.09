<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Products extends Model
{
    use HasFactory, Sluggable;

    //указываем что данная модель отвечает за таблицу 'products'
    protected $table = 'products';


    //у таблицы products к таблице img_product связь один ко многим т.е одному продукту может принадлежать множество картинок . 
    public function images()
    {
    	return $this->hasMany(ProductImage::class , 'product_id' , 'id');
    }


    //у таблицы products к таблице coments связь один ко многим т.е одному продукту может принадлежать множество коментариев .
    public function comments()
    {
      //cразу же фильтруем коментарии по дате - сначала самые новые
      return $this->hasMany(Comment::class , 'product_id' , 'id')->orderBy('created_at','desc');
    }


    //создаем связь один к одному т.е одному продукту может принадлежать одна категория .
    public function categories()
    {
    	return $this->belongsTo(Category::class , 'category_id' , 'id');
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'//слуг будет делать запись в свое поле по макету поля title
            ]
        ];
    }

}
