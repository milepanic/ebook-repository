<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookSearchController extends Controller
{
    public function search(Request $request) 
    {
        $books = Book::searchByQuery([
            'multi_match' => [
                'fields' => ['title', 'author', 'keywords'],
                'query' => $request->title
            ]
        ]);

        return response()->json($books);
    }
}
