<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Trait Responses
 * @package App\Helpers
 */
trait Responses
{
    /**
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponseWithData(array $data, int $code)
    {
        return response()->json(['status' => 'success', 'data' => $data], $code);
    }

    /**
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse(int $code)
    {
        return response()->json(['status' => 'success'], $code);
    }

    /**
     * @param $messages
     * @param int $code
     */
    public function exceptionResponse($messages, int $code)
    {
        $response = response()->json(['status' => 'error', 'messages' => $messages], $code);
        throw new HttpResponseException($response);
    }
}
