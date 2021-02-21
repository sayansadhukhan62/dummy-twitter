<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'PostController@feed')->name('home');
Route::post('/home', 'PostController@feed')->name('home');
Route::get('/create', 'PostController@create')->name('create');
Route::post('/store', 'PostController@store')->name('store');
Route::get('/follow/{user_id}', 'PostController@follow')->name('follow');
Route::get('/unfollow/{user_id}', 'PostController@unfollow')->name('unfollow');
