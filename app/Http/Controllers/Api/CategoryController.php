<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() 
    {
        return Category::all();
    }

    public function store(Request $request) 
    {
        Category::create($request->all());

        return response()->json('Success!', 201);
    }

    public function show(Category $category) 
    {
        return $category;
    }

    public function update(Category $category, Request $request) 
    {
        $category->update($request->all());

        return response()->json('Success!', 200);
    }

    public function destroy(Category $category) 
    {
        $category->delete();

        return response()->json('Success!', 200);
    }
}
