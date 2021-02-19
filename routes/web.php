<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Author\ArticleController;
use App\Http\Controllers\Query\QueryController;

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

//problem 1 route 
Route::get('/query/builder', [QueryController::class, 'create'])->name('problem1');

//problem 2 route 
Route::get('/home', [HomeController::class, 'index'])->name('problem2');
Route::get('/write/article', [ArticleController::class, 'writeArticle'])->name('write.article');
Route::post('/store/article', [ArticleController::class, 'storeArticle'])->name('store.article');
Route::get('/view/all/article', [ArticleController::class, 'viewAllArticle'])->name('view.all.article');

