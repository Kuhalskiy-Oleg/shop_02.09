<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\LogoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [IndexController::class, 'index'])->name('index');



//роут для отображения всех имеющихся категорий
//данные с категориями передаются на все вьюшки через провайдера изза того что в шапку сайта должны парсится категории и чтобы для каждой страницы не прописывать код с обращением к бд мы прописали его один раз в провайдере
Route::view('/categories', 'categories.categories')->name('categories');
//роут для отображения товаров принадлежащей к одной категории
Route::get('/category/{slug}', [CategoriesController::class, 'showCategory'])->name('showCategory');


//роут для отображения всех имеющихся продуктов
Route::get('/products', [ProductController::class, 'products'])->name('products');
//роут для отображения одного выбранного товара
Route::get('/product/{slug}', [ProductController::class, 'showProduct'])->name('showProduct');



//группа маршрутов при переходе на каоторых неаунтефицированного пользователя будет производится редирект на форму с аунтефикацией если мы не ожидваем от сервера данных в формате json
Route::middleware('auth')->group(function () {

	//роут для перехода на страницу kabinet
    Route::view('/kabinet', 'Kabinet.kabinet')->name('kabinet');

    //роут для разлогинивания пользователя
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    
    //роут для оставления коментариев аунтентифицированными пользователями
    Route::post('/product/{slug}', [CommentController::class, 'comment'])->name('comment');

    //роут для перехода на страницу оформления заказа
    Route::get('/checkout', [CheckoutController::class, 'checkoutController'])->name('checkout');

});


//группа маршрутов по котоым могут переходить только НЕаунтентифицированные пользователи
Route::middleware('guest')->group(function () {

	//ДЛЯ всех маршрутов касающихся пользователя и регистрации с аутентификацией определем префикс (auth.)
	Route::name('auth.')->group(function () {

	    //страница Аутентификации
	    Route::view('/login', 'auth.login')->name('login');

	    //при клике на кнопку войти будет вызываться данный контроллер который будет отправлять данные на эту же страницы с аутентификацией
	    Route::post('/login', [LoginController::class, 'loginProcess']);

	    //роут для регистрации пользователей
	    Route::view('/registration', 'auth.registration')->name('registration');

	    //роут для передачи данных с формы регистрации в контроллер RegistrationController в метод save
	    Route::post('/registration', [RegistrationController::class, 'save']);

	    //роуты для отображения страницы с формой восстановления пароля и обработки восстановления пароля
	    Route::view('/forgot', 'auth.forgot')->name('forgot');
	    Route::post('/forgot-process', [ForgotController::class, 'forgot_process'])->name('forgot_process');

	});

});




Route::name('cart.')->group(function () {

	//роут для перехода на страницу cart
	Route::view('/cart', 'cart.cart')->name('view');
	//роут для добавления товара в корзину
	Route::post('/add-in-cart', [CartController::class, 'addInCart'])->name('addInCart');
	//роут для удаления товара из корзины
	Route::post('/del-elem-cart', [CartController::class, 'delElemCart'])->name('delElemCart');
	//роут для удаления всего заказа
	Route::post('/clear-cart', [CartController::class, 'clearCart'])->name('clearCart');
	//роут для редактирования заказа
	Route::post('/edit-cart', [CartController::class, 'editCart'])->name('editCart');

});




//роут для страницы где размещается форма для отравки писем на почту компании
Route::view('/contact', 'ContactForm.contact')->name('contact');
//роут для отправки письма на почту компании
Route::post('/contact-form-process', [ContactController::class, 'contactForm'])->name('contactForm');






