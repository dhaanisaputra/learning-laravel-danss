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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hwg', function () {
    return 'Hello dani ganteng';
});

Route::redirect('/youtube', '/hwg');

Route::fallback( function () {
   return "404 by dansss";
});

Route::view('/hello', 'hello', ['name' => 'Dani']);
//atau
Route::get('hello-again', function () {
   return view('hello', ['name' => 'Dani']);
});

//in directory
Route::get('hello-world', function () {
    return view('hello.world', ['name' => 'Dani']);
});
