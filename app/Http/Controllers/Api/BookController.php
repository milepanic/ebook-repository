<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt.auth', 'jwt.refresh'])->except(['index', 'show']);
    }

    public function index()
    {
        return BookResource::collection(
            Book::with('category')->get()
        );
    }

    public function store(Request $request) 
    {
        Book::create($request->all());

        return response()->json('Success!', 201);
    }

    public function show(Book $book) 
    {
        return new BookResource($book->load('category'));
    }

    public function update(Request $request, Book $book) 
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
