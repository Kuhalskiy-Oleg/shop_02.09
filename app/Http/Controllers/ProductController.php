<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;


class ProductController extends Controller
{
    public function showProduct(string $slug)
    {
    	$product = Products::where('slug',$slug)->first();
        //забираем коментарии которые есть у продукта (связь прописана в модели products)
        $comments = $product->comments;

    	return view('product.show_product',compact('product','comments'));
    }


    public function products(Request $request)
    {

        $products = Products::paginate(8)->withQueryString();
        $products_count_all = Products::all()->count();
        
        if (isset($request->sortBy)) {

            if ($request->sortBy == 'Price_min') {
                //будем сортировать продукты по полю price 
                $products = Products::orderBy('price')->paginate(8)->withQueryString();

            }elseif ($request->sortBy == 'Price_max') {
                //будем сортировать продукты по полю price от max к min
                $products = Products::orderBy('price','desc')->paginate(8)->withQueryString();

            }elseif ($request->sortBy == 'Name-A-z') {
                //будем сортировать продукты по полю title по алфавиту
                $products = Products::orderBy('title')->paginate(8)->withQueryString();

            }elseif ($request->sortBy == 'Name-Z-a') {
                //будем сортировать продукты по полю title по алфавиту
                $products = Products::orderBy('title','desc')->paginate(8)->withQueryString();
            }

            //Defoult сортировка будет работать и без условия if т.к програма не видит условия if где значение sortBy сравнивается с "Defoult" и она выходит из условия и загружает на страницу объект который идет по умолчанию $products = Products::all();
        }


        //__________________ПАГИНАЦИЯ________________
        if (isset($products)) {
            $response = array(
                'status' => 'success',
                "products" => $products,
                "request" => $request->all(),
                'pagination' => $products->appends(request()->query())->links("pagination.pagination_products")
            );
        }
            
        
        //по ajax мы будем отправялть на страницу не переменную и ее значение а срузе же готовый html код и этот код в ajax скрипте мы будем помещать методом html в тег в котором у нас хранятся все товары ну а старый код автоматически удалится
        //для этого нуужно созать отдельный файл где будет генерироваться код с продуктами через цикл foreach такой же как и на самой странице products из объекта $products
        if ($request->ajax()) {
            return view('ajax.ajax_filtr_products',compact('response'))->render();
        }
                
        return view('product.products',compact('products','products_count_all'));

    }
   
}
