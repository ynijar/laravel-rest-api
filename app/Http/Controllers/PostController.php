<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
use App\Post;
use App\Services\PostService;
use Illuminate\Http\Response;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PostSearchRequest $request, PostService $postService)
    {
        $request->validated();
        $response = $postService->_list($request);
        return $this->successResponseWithData($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @param PostService $postService
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(PostRequest $request, PostService $postService)
    {
        $request->validated();

        $postService->create($request);
        return $this->successResponse(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @param PostService $postService
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post, PostService $postService)
    {
        $response = $postService->get($post);
        return $this->successResponseWithData($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @param PostService $postService
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(PostRequest $request, Post $post, PostService $postService)
    {
        $request->validated();
        $response = $postService->update($request, $post);

        return $this->successResponseWithData($response, Response::HTTP_OK);
    }
}
