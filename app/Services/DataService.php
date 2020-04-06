<?php

namespace App\Services;

use App\GuzzlePost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


/**
 * Class DataService
 * @package App\Services
 */
class DataService extends Service
{
    public $guzzleService;

    public function __construct(GuzzleService $guzzleService)
    {
        $this->guzzleService = $guzzleService;
    }

    /**
     * Get and save posts
     *
     * @param Request $request
     * @return bool
     */
    public function savePostInGuzzlePost(Request $request)
    {

        $response = $this->guzzleService->getData($request, config('guzzle.url'));

        if ($response->status === 'success') {

            try {
                DB::beginTransaction();

                foreach ($response->data->list as $post) {

                    $guzzlePost = new GuzzlePost;

                    $guzzlePost->name = $post->name;
                    $guzzlePost->save();
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->exceptionResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }

        } else {
            $this->exceptionResponse($response->messages, Response::HTTP_BAD_REQUEST);
        }

        return true;
    }
}
