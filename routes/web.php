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

Route::get('/', function () {
    return view('site.index');
})->name('home');

Route::get('/about', function () {
    return view('site.about');
})->name('about');

Route::get('/tree_of_employees', 'TreeOfEmployeesController@show')->name('nested_sets');


Route::resource('managers', 'ManagerController');
Route::resource('employees', 'EmployeeController');
Route::resource('employees', 'EmployeeController');
Route::resource('positions', 'PositionController');

Auth::routes();


