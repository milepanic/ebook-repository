<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['jwt.auth', 'jwt.refresh'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    
    Route::apiResource('books', 'BookController')->except('update');
    Route::post('books/update/{book}', 'BookController@update')->name('books.update');
    Route::get('books/{book}/download', 'BookController@download')->name('books.download');

    Route::apiResource('categories', 'CategoryController');

    Route::apiResource('users', 'UserController');
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
});
