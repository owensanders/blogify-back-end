<?php

namespace App\Http\Controllers;

use App\DtoFactories\PostDtoFactory;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\UseCases\CommentOnPostUseCase;
use App\UseCases\CreatePostUseCase;
use App\UseCases\DeletePostUseCase;
use App\UseCases\GetFeedPostsUseCase;
use App\UseCases\GetPostForUpdate;
use App\UseCases\GetPostsByAuthorUseCase;
use App\UseCases\LikePostUseCase;
use App\UseCases\UpdatePostUseCase;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private $getFeedPostsUseCase;
    private $getPostsByAuthorUseCase;
    private $createPostUseCase;
    private $getPostForUpdateUseCase;
    private $updatePostUseCase;
    private $deletePostUseCase;
    private $likePostUseCase;
    private $commentOnPostUseCase;

    public function __construct(
        GetFeedPostsUseCase $getFeedPostsUseCase,
        GetPostsByAuthorUseCase $getPostsByAuthorUseCase,
        CreatePostUseCase $createPostUseCase,
        GetPostForUpdate $getPostForUpdateUseCase,
        UpdatePostUseCase $updatePostUseCase,
        DeletePostUseCase $deletePostUseCase,
        LikePostUseCase $likePostUseCase,
        CommentOnPostUseCase $commentOnPostUseCase
    ) {
        $this->getFeedPostsUseCase = $getFeedPostsUseCase;
        $this->getPostsByAuthorUseCase = $getPostsByAuthorUseCase;
        $this->createPostUseCase = $createPostUseCase;
        $this->getPostForUpdateUseCase = $getPostForUpdateUseCase;
        $this->updatePostUseCase = $updatePostUseCase;
        $this->deletePostUseCase = $deletePostUseCase;
        $this->likePostUseCase = $likePostUseCase;
        $this->commentOnPostUseCase = $commentOnPostUseCase;
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
        $this->deletePostUseCase->handle($id);

        return response()->json(['message' => 'Post deleted successfully.']);
    }

    public function like(int $id): JsonResponse
    {
        $this->likePostUseCase->handle($id);

        return response()->json(['message' => 'Post liked successfully.']);
    }

    public function comment(CommentRequest $request): JsonResponse
    {
        $dto = PostDtoFactory::fromRequest($request);
        $this->commentOnPostUseCase->handle($dto);

        return response()->json(['message' => 'Post commented successfully.']);
    }
}
