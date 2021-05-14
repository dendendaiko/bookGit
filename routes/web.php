<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

use App\Http\Controllers\HomeController;

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


// トップ画面表示
Route::get('/', [BookController::class, 'top'])->name('top');



// ユーザー関係　ログインなど
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 一覧画面表示
Route::get('/book/list', [BookController::class, 'bookList'])->name('list');
// 一覧画面表示 + 検索
Route::get('/book/list/{request}', [BookController::class, 'bookSearch']);

// 新規投稿画面
Route::get('/book/create', [BookController::class, 'bookCreate'])->name('bookCreate');
// 新規投稿
Route::post('/book/post', [BookController::class, 'bookPost'])->name('newPost');

// 詳細画面表示
Route::get('/book/{id}', [BookController::class, 'bookDetail'])->name('show');

// 投稿編集画面
Route::get('/book/edit/{id}', [BookController::class, 'bookEdit'])->name('bookEdit');
// 投稿編集
Route::post('/book/update}', [BookController::class, 'bookUpdate'])->name('bookUpdate');

// 投稿削除
Route::post('/book/delete/{id}', [BookController::class, 'bookDelete'])->name('bookDelete');
