<?php

namespace App\Http\Controllers;

use App\Services\DataService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class DataController
 * @package App\Http\Controllers
 */
class DataController extends ApiController
{
    public function postRequest(Request $request, DataService $dataService)
    {
        $dataService->savePostInGuzzlePost($request);
        return $this->successResponse(Response::HTTP_CREATED);
    }
}
