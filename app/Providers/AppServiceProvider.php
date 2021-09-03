<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //проверка на существование таблицы (чтобы не возникало ошибок если таблицы "categories" не будет в бд)
        if (Schema::hasTable ('categories')) {

            //создаем переменную с категориями которая будет доступна во всех вьюшках
            $categories = Category::all();
            View::share([
                'categories' => $categories
            ]);
        }

    }
}
