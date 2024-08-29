<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    private function getCacheKey(int $id): string
    {
        return "posts_author_$id";
    }

    public function feed(): JsonResponse
    {
        $posts = Post::where('author_id', '!=', auth()->user()->id)->get();

        return response()->json(['posts' => $posts]);
    }

    public function index(int $id): JsonResponse
    {
        $cacheKey = $this->getCacheKey($id);

        $posts = Cache::remember($cacheKey, 60 * 60, function () use ($id) {
            return Post::where('author_id', $id)->get();
        });

        return response()->json(['posts' => $posts]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'body' => 'required|max:500',
        ]);

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'author_id' => auth()->id(),
        ]);

        $cacheKey = $this->getCacheKey(auth()->id());

        Cache::forget($cacheKey);

        return response()->json(['message' => 'Post created successfully.']);
    }

    public function show(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);

        return response()->json(['post' => $post]);
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|int',
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $post = Post::findOrFail($request->id);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $cacheKey = $this->getCacheKey($post->author_id);

        Cache::forget($cacheKey);

        return response()->json(['message' => 'Post updated successfully.']);
    }

    public function destroy(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $authorId = $post->author_id;
        $post->delete();

        $cacheKey = $this->getCacheKey($authorId);

        Cache::forget($cacheKey);

        return response()->json(['message' => 'Post deleted successfully.']);
    }
}
