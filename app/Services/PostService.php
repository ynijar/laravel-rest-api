<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Throwable;

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

        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $queryCount = $query->count();

        $query->limit($request->limit);
        $query->offset($request->offset);

        $query->with('user');

        return [
            'list' => PostResource::collection($query->get()),
            'listCount' => $queryCount,
        ];
    }

    /**
     * Create new model Post
     *
     * @param PostRequest $request
     * @return bool
     */
    public function create(PostRequest $request): bool
    {
        $post = new Post;

        $post->name = $request->name;
        $post->description = $request->description;
        $post->user_id = $this->getUser()->id;

        return $post->save();
    }

    /**
     * Update model Post
     *
     * @param PostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostRequest $request, Post $post): PostResource
    {
        $post->name = $request->name;
        $post->description = $request->description;

        $post->save();

        return new PostResource($post);
    }

    /**
     * Get model Post
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
     * @throws Throwable
     */
    public function delete(Post $post): bool
    {
        return $post->delete();
    }
}
