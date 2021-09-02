<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    //метод для отображения всех товаров относящихся к одной выбранной категории
    public function showCategory(Request $request, string $slug)
    {
    	$category = Category::where('slug',$slug)->first();
    	
    	//если бд пустая (нет категорий) то при $category->products()->paginate(8)->withQueryString() возникнит ошибка
    	//чтобы избежать ошибки воспользуемся тернарным оператором - если переменная $category будет = null то в переменную products_from_category мы запишем null
    	$products_from_category = $category ? $category->products()->paginate(8)->withQueryString() : null;

        //если продуктов не будет в бд то ошибке не возникнит при использованиее count() но вот если нет категорий то ошибка возникнет
    	$products_from_category_count = $category ?  $category->products()->count() : null;
    	
    	//__________________СОРТИРОВКА________________
    	//если мы нажали на кнопку сортировки у в переменной sortBy записалось значение переменной то мы будем производить фильтрацию по этому значению переменной
        if (isset($request->sortBy)) {

            if ($request->sortBy == 'Price_min') {
                //будем сортировать продукты по полю price / по умолчанию у orderBy сортировка идет по ASC(от min к max)
                $products_from_category = $category->products()->orderBy('price')->paginate(8)->withQueryString();

            }elseif ($request->sortBy == 'Price_max') {
                //будем сортировать продукты по полю price от max к min
                $products_from_category = $category->products()->orderBy('price','desc')->paginate(8)->withQueryString();

            }elseif ($request->sortBy == 'Name-A-z') {
                //будем сортировать продукты по полю title по алфавиту
                $products_from_category = $category->products()->orderBy('title')->paginate(8)->withQueryString();

            }elseif ($request->sortBy == 'Name-Z-a') {
                //будем сортировать продукты по полю title по алфавиту
                $products_from_category = $category->products()->orderBy('title','desc')->paginate(8)->withQueryString();
            }

            //Defoult сортировка будет работать и без условия if т.к програма не видит условия if где значение sortBy сравнивается с "Defoult" и она выходит из условия и загружает на страницу объект который идет по умолчанию $products = Products::all();
        }


        //__________________ПАГИНАЦИЯ________________
        //если переменная $products_from_category не равна null то мы запишем в переменную response вариант ответа с сервера на ajax запрос
        if (isset($products_from_category)) {
        	
        	$response = array(
				'status' => 'success',
				"products_from_category" => $products_from_category,
				"request" => $request->all(),
				'pagination' => $products_from_category->appends(request()->query())->links("pagination::bootstrap-4")
			);
        }
        
        

        //по ajax мы будем отправялть на страницу не переменную и ее значение а срузе же готовый html код и этот код в ajax скрипте мы будем помещать методом html в тег в котором у нас хранятся все товары ну а старый код автоматически удалится
        //для этого нуужно создать отдельный файл где будет генерироваться код с продуктами через цикл foreach такой же как и на самой странице products из объекта $products
        if ($request->ajax()) {
        	return view('ajax.ajax_paginate_show_category',compact('response'))->render();
        	return response()->json($response);
        }
        
    	return view('categories.show_category',compact( 'category',
                                                        'products_from_category',
                                                        'products_from_category_count',
        ));
    }


}



