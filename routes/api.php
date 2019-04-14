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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::get('books', 'BooksController@index');
    Route::post('books', 'BooksController@store');
    Route::get('books/{book}', 'BooksController@show');
    Route::put('books/{book}', 'BooksController@update');
    Route::delete('books/{book}', 'BooksController@destroy');
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
});
