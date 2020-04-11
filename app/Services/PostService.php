<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class PostService
 * @package App\Services
 */
class PostService extends Service
{
    /**
     * Get posts with relations by filter
     *
     * @param PostSearchRequest $request
     * @return array
     */
    public function _list(PostSearchRequest $request): array
    {
        $query = Post::where([]);

        $query->where(function ($query) use ($request) {
            $query->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        });

        $queryWithoutLimit = clone $query;

        $query->limit($request->limit);
        $query->offset($request->offset);

        $posts = PostResource::collection($query->get());

        return [
            'list' => $posts,
            'listCount' => $queryWithoutLimit->count(),
        ];
    }

    /**
     * Create new model Post
     *
     * @param PostRequest $request
     * @return bool
     */
    /**
     * @param PostRequest $request
     * @return Post
     */
    public function create(PostRequest $request): Post
    {
        $post = new Post;

        try {

            $post->name = $request->name;
            $post->description = $request->description;
            $post->user_id = Auth::user()->id;

            $post->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->exceptionResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $post;
    }

    /**
     * Update model Product
     *
     * @param PostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostRequest $request, Post $post): PostResource
    {
        try {
            DB::beginTransaction();

            $post->name = $request->name;
            $post->description = $request->description;

            $post->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->exceptionResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new PostResource($post);
    }

    /**
     * Get model Post with relations
     *
     * @param Post $post
     * @return PostResource
     */
    public function get(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * Delete model Post
     *
     * @param Post $post
     * @return bool
     * @throws \Exception
     */
    public function delete(Post $post): bool
    {
        $post->delete();

        return true;
    }
}
