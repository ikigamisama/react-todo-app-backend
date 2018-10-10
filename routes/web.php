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

Route::get('/', 'PageController@index');
Route::get('/about','PageController@about');

Route::resource('todo','TodoController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/fetchdata','DashboardController@getFetchData');
Route::get('/dashboard/edit_todo_done/{id}/{isChecked}','DashboardController@updateTodoListChecked');
Route::get('/dashboard/count','DashboardController@getAllStatisticTodoApp');