<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class BooksController
{
    public function index()
    {
        return Book::all();
    }

    public function store(BookRequest $request) 
    {
        Book::create($request->all());

        return response()->json('Success!', 201);
    }

    public function show(Book $book) 
    {
        return $book;
    }

    public function update(Book $book, Request $request) 
    {
        $book->update($request->all());

        return response()->json('Success!', 200);
    }

    public function destroy(Book $book) 
    {
        $book->delete();

        return response()->json('Success!', 200);
    }
}
