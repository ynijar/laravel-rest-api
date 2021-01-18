<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
use App\Post;
use App\Services\PostService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param PostSearchRequest $request
     * @param PostService $postService
     * @return JsonResponse
     */
    public function index(PostSearchRequest $request, PostService $postService): JsonResponse
    {
        $response = $postService->_list($request);
        return $this->successResponseWithData($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @param PostService $postService
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(PostRequest $request, PostService $postService): JsonResponse
    {
        $postService->create($request);
        return $this->successResponse(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @param PostService $postService
     * @return JsonResponse
     */
    public function show(Post $post, PostService $postService): JsonResponse
    {
        $response = $postService->get($post);
        return $this->successResponseWithData($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @param PostService $postService
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(PostRequest $request, Post $post, PostService $postService): JsonResponse
    {
        $response = $postService->update($request, $post);
        return $this->successResponseWithData($response);
    }

    /**
     * Destroy the specified resource in storage.
     *
     * @param Post $post
     * @param PostService $postService
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Post $post, PostService $postService): JsonResponse
    {
        $postService->delete($post);
        return $this->successResponse(Response::HTTP_OK);
    }
}
