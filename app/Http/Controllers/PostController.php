<?php

namespace App\Http\Controllers;

use App\DtoFactories\PostDtoFactory;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\UseCases\CreatePostUseCase;
use App\UseCases\GetFeedPostsUseCase;
use App\UseCases\GetPostForUpdate;
use App\UseCases\GetPostsByAuthorUseCase;
use App\UseCases\PostService;
use App\UseCases\UpdatePostUseCase;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private $postService;
    private $getFeedPostsUseCase;
    private $getPostsByAuthorUseCase;
    private $createPostUseCase;
    private $getPostForUpdateUseCase;
    private $updatePostUseCase;

    public function __construct(
        PostService $postService,
        GetFeedPostsUseCase $getFeedPostsUseCase,
        GetPostsByAuthorUseCase $getPostsByAuthorUseCase,
        CreatePostUseCase $createPostUseCase,
        GetPostForUpdate $getPostForUpdateUseCase,
        UpdatePostUseCase $updatePostUseCase
    ) {
        $this->postService = $postService;
        $this->getFeedPostsUseCase = $getFeedPostsUseCase;
        $this->getPostsByAuthorUseCase = $getPostsByAuthorUseCase;
        $this->createPostUseCase = $createPostUseCase;
        $this->getPostForUpdateUseCase = $getPostForUpdateUseCase;
        $this->updatePostUseCase = $updatePostUseCase;
    }

    public function feed(): JsonResponse
    {
        $posts = $this->getFeedPostsUseCase->handle();

        return response()->json(['posts' => $posts->toArray()]);
    }

    public function index(int $id): JsonResponse
    {
        $posts = $this->getPostsByAuthorUseCase->handle($id);

        return response()->json(['posts' => $posts]);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $dto = PostDtoFactory::fromRequest($request);
        $this->createPostUseCase->handle($dto);

        return response()->json(['message' => 'Post created successfully.']);
    }

    public function show(int $id): JsonResponse
    {
        $post = $this->getPostForUpdateUseCase->handle($id);

        return response()->json(['post' => $post]);
    }

    public function update(UpdatePostRequest $request): JsonResponse
    {
        $dto = PostDtoFactory::fromRequest($request);

        $this->updatePostUseCase->handle($dto);

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
