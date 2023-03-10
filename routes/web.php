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

//Route with param and named route
Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{products}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Items $itemId";
})->name('product.item.detail');

//Route with regex
Route::get('/categories/{id}', function (string $categoryId) {
   return "Categories : ".$categoryId;
})->where('id', '[0-9]+')->name('category.detail');

//Route param optional
Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
})->name('user.detail');


//Route param conflict, prioritas adalah yg paling atas
Route::get('/conflict/dans', function () {
    return "Conflict dani ganteng";
});

Route::get('/conflict/{name}',function ($name) {
   return "Conflict $name";
});


//Route with link
Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link : $link";
});

Route::redirect('/produk-redirect/{id}', function ($id) {
   return redirect()->route('product.detail', ['id' => $id]);
});

//controller
Route::get('controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('input/hello', [\App\Http\Controllers\InputController::class, 'hello']);

Route::post('input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName']);
Route::post('input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);
Route::post('input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray']);
Route::post('input/type', [\App\Http\Controllers\InputController::class, 'inputType']);
Route::post('input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);
Route::post('input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);
