<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CartController extends Controller
{
   
    //метод для добавления товара в корзину 
    public function addInCart(Request $request)
    {
    	//проверка на Аутентификацию пользователя
    	if (Auth::check()) {

    		//находим товар который пользователь добавляет в корзину по его id полученного из ajax запроса
    		$product = Products::where( 'id',$request->id )->first();
		    
		    //получаем id пользователя	     
		    $userId = Auth::user()->id;

    		//создаем сессию, id которой будет равен id пользователя
	    	\Cart::session( $userId );

			//добавляем продукт в корзину
	    	\Cart::add(array(
			    'id'         => (int) $request->id, 
			    'name'       => $product->title,
			    //если новой цены нет то запишем основную цену (без скидок)
			    'price'      => isset($product->new_price) ? $product->new_price : $product->price ,
			    'quantity'   => $request->count,
			    'attributes' => [
			    	//записываем первую картинку из всех возможных от данногго товара
			    	'img'  => isset($product->images[0]->img) ? $product->images[0]->img : 'images/not_file.png',
			    	'slug' => $product->slug,
			    ]
			));
	    	
			//готовим ответ
			return response()->json([
				'cart' => \Cart::getContent(),
				'id user' => $userId
			]);

		//если пользователь не прошел Аутентификацию и решил добавить товар в корзину
		}else{

			//возвращаем ответ с ошибкой
			return response()->json([
				'status'  => 'error',
				'messege' => "Для совершения покупок вы должны войти на сайт\nПерейти к странице входа ?",
			]);
		}

    }


    //метод для редактирования кол-ва выбранного товара
    public function editCart(Request $request)
    {
    	//проверка на Аутентификацию пользователя
    	if (Auth::check()) {

    		//производим валидацию полученных данных из формы
	    	$validateData = $request->validate([ 
	    		'id'     => 'numeric',
	    		'count'  => 'bail|numeric|max:100|min:0|regex:/^[0-9]*$/',
	    	]);
    	   
			$userId = Auth::user()->id;
			\Cart::session( $userId );

			//обновляем в корзине кол-во выбранного товара
	    	\Cart::update( $request->id , [
				'quantity' => [
				      'relative' => false,
				      'value' => $request->count
				  ],
			]);

	    	//готовим ответ
			$response = array(
				'result'  => 'success',
				'request' => $request->all(),
				'cart'    => \Cart::getTotal(), //общая сумма всех товаров
				'count'   => \Cart::getTotalQuantity(), //обее число всех товаров (штук)
				'price'   => \Cart::get($request->id)->getPriceSum() //цена у одногго товара
			);

			//возвращаем ответ клиенту
			return response()->json($response);

		//если пользователь не прошел Аутентификацию и решил добавить товар в корзину
		}else{

			//возвращаем ответ с ошибкой
    		return response()->json([ 
	    		'result' => 'not auth user',
	    	]);
    	}

    }


    //метод для удаления товара из корзины
    public function delElemCart(Request $request)
    {	
    	//проверка на Аутентификацию пользователя
    	if (Auth::check()) {
    	   
			$userId = Auth::user()->id;
			\Cart::session( $userId );

	    	//удаляем выбранне товары из заказа по их id в корзине
	    	\Cart::remove($request->id);

	    	//готовим ответ
	    	$response = array(
				'result' => 'success',
				"id"     => $request->id ,
				'cart'    => \Cart::getTotal(), 
				'count'   => \Cart::getTotalQuantity()	
			);

			//возвращаем ответ клиенту
			return response()->json($response);

		//если пользователь не прошел Аутентификацию и решил добавить товар в корзину
		}else{

			//возвращаем ответ с ошибкой
    		return response()->json([ 
	    		'result' => 'not auth user',
	    	]);
    	}
    }


    //удаление всего заказа
    public function clearCart()
    {
    	//проверка на Аутентификацию пользователя
    	if (Auth::check()) {

    		$userId = Auth::user()->id;
			\Cart::session( $userId );
    		
    		//удаляем все товары в корзине
    		\Cart::clear();

    		//возвращаем ответ клиенту
	    	return response()->json([ 
	    		'result' => 'success',
	    	]);

	    //если пользователь не прошел Аутентификацию и решил добавить товар в корзину
    	}else{

    		//возвращаем ответ с ошибкой
    		return response()->json([ 
	    		'result' => 'not auth user',
	    	]);
    	}
    	
    }
}
