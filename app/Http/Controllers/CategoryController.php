<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return CategoryResource::collection($category)
            ->response()
            ->setStatusCode(200);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(200);
    }

    public function show(Category $category)
    {
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(200);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        $category->update($validatedData);
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
