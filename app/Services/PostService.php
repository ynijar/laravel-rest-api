<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
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
        $posts = Post::where([]);

        $posts->where(function ($query) use ($request) {
            $query->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        });

        $countPosts = clone $posts;

        $posts->limit($request->limit);
        $posts->offset($request->offset);

        $responses = [];

        /** @var Post $post */
        foreach ($posts->get() as $post) {
            $response = $post->toArray();
            $response['user'] = $post->user->toArray();

            $responses[] = $response;
        }

        return [
            'list' => $responses,
            'listCount' => $countPosts->count(),
        ];
    }

    /**
     * Create new model Post
     *
     * @param PostRequest $request
     * @return bool
     * @throws \Throwable
     */
    public function create(PostRequest $request): bool
    {
        try {
            $post = new Post;

            $post->name = $request->name;
            $post->description = $request->description;
            $post->user_id = Auth::user()->id;

            $post->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->exceptionResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return true;
    }

    /**
     * Update model Product
     *
     * @param PostRequest $request
     * @param Post $post
     * @return array
     */
    public function update(PostRequest $request, Post $post): array
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

        return $this->get($post);
    }

    /**
     * Get model Post with relations
     *
     * @param Post $post
     * @return array
     */
    public function get(Post $post): array
    {
        $response = $post->toArray();
        $response['user'] = $post->user->toArray();

        return $response;
    }
}
