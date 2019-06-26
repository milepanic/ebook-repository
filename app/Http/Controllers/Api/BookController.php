<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Services\FileService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        // $this->middleware(['jwt.auth', 'jwt.refresh'])->except(['index', 'show']);
        $this->fileService = $fileService;
    }

    public function index()
    {
        return BookResource::collection(
            Book::with('category')->get()
        );
    }

    public function store(BookRequest $request) 
    {
        $book = Book::create(
            array_merge(
                $request->except('file'), [
                    'filename' => $request->file->getClientOriginalName(),
                    'mime' => $request->file->getClientMimeType()
                ]
            )
        );

        $this->fileService->upload(
            $request->file, "books/$book->id/", $request->file->getClientOriginalName(), true
        );

        return response()->json('Success!', 201);
    }

    public function show(Book $book) 
    {
        return new BookResource($book->load('category'));
    }

    public function update(BookRequest $request, Book $book) 
    {
        if ($request->hasFile('file')) {
            $book->update(
                array_merge(
                    $request->except('file'), [
                        'filename' => $request->file->getClientOriginalName(),
                        'mime' => $request->file->getClientMimeType()
                    ]
                )
            );

            $this->fileService->upload(
                $request->file, "books/$book->id/", $request->file->getClientOriginalName(), true
            );
        } else {
            $book->update($request->except('file'));
        }

        return response()->json('Success!', 200);
    }

    public function destroy(Book $book) 
    {
        $book->delete();

        return response()->json('Success!', 200);
    }

    public function download(Book $book) 
    {
        return response()->download(
            storage_path("app/public/books/$book->id/$book->filename", 'aa', ['Content-Type' => 'application/pdf'])
        );
    }
}
