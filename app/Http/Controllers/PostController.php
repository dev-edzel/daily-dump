<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('search');

        $posts = Post::search($query)->paginate(10);

        return PostResource::collection($posts);
    }

    public function store(PostRequest $request)
    {
        try {
            $posts = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'author' => $request->author,
                'category_id' => $request->category_id,
            ]);

            $posts->category()->associate($request->category_id);


            return new PostResource($posts);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Post $posts)
    {
        return new PostResource($posts);
    }

    public function update(PostRequest $request, Post $posts)
    {
        try {
            $posts->update($request->validated());

            $posts->category()->associate($request->category_id);
            return new PostResource($posts);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Post $posts)
    {
        $posts->delete();
        return response()->noContent();
    }

    public function getPostByCategory($category)
    {
        $category = Category::where('name', $category)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found']);
        }

        $posts = Post::where('category_id', $category->id)->with('category')->paginate(10);

        return PostResource::collection($posts);
    }
}
