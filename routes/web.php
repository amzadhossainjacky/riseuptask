<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Author\ArticleController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//problem 2 route 
Route::get('/home', [HomeController::class, 'index'])->name('problem2');
Route::get('/write/article', [ArticleController::class, 'writeArticle'])->name('write.article');
Route::post('/store/article', [ArticleController::class, 'storeArticle'])->name('store.article');
Route::get('/view/all/article', [ArticleController::class, 'viewAllArticle'])->name('view.all.article');

