<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function feed(): JsonResponse
    {
        $posts = $this->postService->getFeedPosts(auth()->user()->id)->toArray();

        return response()->json(['posts' => array_values($posts)]);
    }

    public function index(int $id): JsonResponse
    {
        $posts = $this->postService->getPostsByAuthor($id);

        return response()->json(['posts' => $posts]);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $this->postService->createPost($request->validated(), auth()->id());

        return response()->json(['message' => 'Post created successfully.']);
    }

    public function show(int $id): JsonResponse
    {
        $post = $this->postService->getPostById($id);

        return response()->json(['post' => $post]);
    }

    public function update(UpdatePostRequest $request): JsonResponse
    {
        $this->postService->updatePost($request->validated());

        return response()->json(['message' => 'Post updated successfully.']);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->postService->deletePost($id);

        return response()->json(['message' => 'Post deleted successfully.']);
    }

    public function like(int $id): JsonResponse
    {
        $this->postService->likePost($id);

        return response()->json(['message' => 'Post liked successfully.']);
    }

    public function comment(CommentRequest $request): JsonResponse
    {
        $this->postService->commentOnPost($request->validated());

        return response()->json(['message' => 'Post commented successfully.']);
    }
}
