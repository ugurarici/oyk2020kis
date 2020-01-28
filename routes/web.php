<?php

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

Route::view('vuetest', 'vuetest');

Route::get('/', function () {
    return view('welcome');
});

Route::get('falan', function(){
    return App\TodoItem::all();
});

//  bütün todo listesi
//  yeni bir todo ekleme işlemi
//  bir todo'yu tamamlandı işaretleme
//  bir todo'yapılmadı işaretleme

Route::get('todos', 'TodoItemController@index')->name('todos.all')->middleware(['auth']);
Route::get('todos/{todo}/togglecomplete', 'TodoItemController@toggle')->name('todos.toggle')->middleware(['auth']);
Route::post('todos', 'TodoItemController@store')->name('todos.store')->middleware(['auth']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
