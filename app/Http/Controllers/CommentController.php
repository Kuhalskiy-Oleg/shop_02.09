<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Comment;
use App\Http\Requests\CommentsForm;

class CommentController extends Controller
{
    //метод для добавления коментария в бд
    public function comment($slug, CommentsForm $request)
    {
        //ищем товар на который оставили отзыв
    	$product = Products::where('slug', $slug)->first();

    	//добавляем коментарий в таблицу с помошью метода create
    	//берем отвалидированные данные из класса CommentsForm
    	$comment = Comment::create([
    		'text'       => $request->validated()['text'],
    		'user_id'    => $request->validated()['user_id'],
    		'product_id' => $product->id,	
    	]);

    	//если коментарий добавлен успешно то мы делаем редирект на ту же страницу с которой был отправлен коментарий 
    	if ($comment) {
    		return redirect("/product/$slug");
    	} 	
    }
}
