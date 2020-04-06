<?php

namespace Tests\Unit;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testCheckCreateNewPost()
    {
        Event::fake();

        /** @var PostService $postService */
        $postService = resolve(PostService::class);

        $user = User::find(1);

        /** @var PostRequest $data */
        $request = new PostRequest([
            'name' => 'test name',
            'description' => 'test description',
        ]);

        $this->be($user);

        $newPost = $postService->create($request);

        $postService->delete($newPost);

        self::assertTrue(true);

    }
}
