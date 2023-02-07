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

//Route with param
Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
});

Route::get('/products/{products}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Items $itemId";
});

//Route with regex
Route::get('/categories/{id}', function (string $categoryId) {
   return "Categories : ".$categoryId;
})->where('id', '[0-9]+');

//Route param optional
Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
});


//Route param conflict, prioritas adalah yg paling atas
Route::get('/conflict/{name}',function ($name) {
   return "Conflict $name";
});

Route::get('/conflict/dans', function () {
    return "Conflict dani ganteng";
});


