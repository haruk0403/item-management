<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'item']);
    // アイテム削除機能
    Route::post('/destroy{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item.destroy');
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
    Route::post('edit/{id}', [App\Http\Controllers\ItemController::class,'postEdit'])->name('items.postEdit');
    Route::post('postEdit',[\App\Http\Controllers\ItemController::class,'postEdit'])->name('postEdit');
});
Route::group(['middleware' => ['auth', 'can:Admin']], function () {
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::post('/user/edit/{id}', [App\Http\Controllers\UserController::class,'postEdit'])->name('users.postEdit');
Route::post('/user/postEdit',[\App\Http\Controllers\UserController::class,'postEdit'])->name('postEdit');
});