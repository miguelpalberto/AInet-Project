<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TshirtImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

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

Route::view('/', 'home')->name('root');

// Route::get('users', [UserController::class, 'index'])->name('users.index');
// Route::get('users/create', [UserController::class, 'create'])->name('users.create'); //aqui "users/create" é modificável (url que desejamos)
// Route::post('users', [UserController::class, 'store'])->name('users.store');
// Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
// Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
Route::resource('users', UserController::class); //igual às 7 rotas acima (7 em 1)

//Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
Route::resource('customer', CustomerController::class);

Route::resource('tshirtImages', TshirtImageController::class);

Route::resource('categories', CategoryController::class);

Route::resource('orders', OrderController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::view('teste', 'template.layout');
