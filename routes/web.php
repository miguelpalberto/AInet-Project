<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TshirtImageController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\TshirtPreviewController;
use App\Models\Order;
use App\Models\TshirtImage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::view('teste', 'template.layout');
Route::view('/', 'home')->name('root');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['verify' => true]);

// Route::get('users', [UserController::class, 'index'])->name('users.index');
// Route::get('users/create', [UserController::class, 'create'])->name('users.create'); //aqui "users/create" é modificável (url que desejamos)
// Route::post('users', [UserController::class, 'store'])->name('users.store');
// Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
// Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

Route::group(['middleware' => ['auth', 'verified', 'can:userActive']], function () { //Auth

    Route::resource('users', UserController::class); //igual às 7 rotas acima (7 em 1)
    Route::resource('customers', CustomerController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('prices', PriceController::class)->except(['delete', 'create', 'store']);//TODO rota apenas de editar e ver?

});
Route::get('tshirtImages/{tshirtImage}/createOrderItem', [TshirtImageController::class, 'createOrderItem'])->name('tshirtImages.createOrderItem');
Route::resource('tshirtImages', TshirtImageController::class);


Route::patch('/orders/{order}/mark-as-closed', [OrderController::class, 'markAsClosed'])->name('ordersClosed');
Route::patch('/orders/{order}/mark-as-paid', [OrderController::class, 'markAsPaid'])->name('ordersPaid');


Route::get('orders/minhasFunc', [OrderController::class, 'minhasOrdersFuncionario'])->name('orders.minhasFunc');
Route::get('orders/minhas', [OrderController::class, 'minhasOrders'])->name('orders.minhas');
Route::resource('orders', OrderController::class)->except(['create', 'store']);



Route::resource('orderItems', OrderItemController::class)->only(['create', 'destroy']);




Route::get('/password/change', [ChangePasswordController::class, 'show'])
    ->name('password.change.show');
Route::post('/password/change', [ChangePasswordController::class, 'store'])
    ->name('password.change.store');


Route::patch('/users/{user}/blocked', [UserController::class, 'changeBlocked'])->name('usersBlock');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Adicionar img tshirt ao carrinho
Route::post('cart/{tshirtImage}', [CartController::class, 'addToCart'])->name('cart.add');
//Route::post('cart/{orderItem}', [CartController::class, 'addToCart'])->name('cart.add');
// Remover img tshirt ao carrinho
Route::delete('cart/{index}', [CartController::class, 'removeFromCart'])->name('cart.remove');
// Mostrar carrinho
Route::get('cart', [CartController::class, 'show'])->name('cart.show');
// Gravar encomenda
Route::post('cart', [CartController::class, 'store'])->name('cart.store');
// Limpar carrinho
Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');

Route::delete('users/{user}/foto', [UserController::class, 'destroy_foto'])
    ->name('users.foto.destroy');



// Carrinho
//Route::resource('cart', CartController::class);


// Route::get('/tshirt/preview', [TshirtPreviewController::class, 'createPreview']);
Route::get('/preview', [TshirtPreviewController::class, 'createPreview'])->name('preview.create');
Route::post('/preview/update', [TshirtPreviewController::class, 'createPreview'])->name('preview.update');

