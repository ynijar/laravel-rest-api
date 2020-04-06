<?php

namespace App\Services;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Psr7;

/**
 * Class GuzzleService
 * @package App\Services
 */
class GuzzleService extends Service
{
    public function getData(Request $request, string $url)
    {
        $headerAuthorization = $request->header('Authorization');

        $client = new \GuzzleHttp\Client();
        $response = null;

        try {
            $requestG = new Psr7\Request('GET', '');

            $baseUri = new Uri($url);
            $baseRequest = $requestG
                ->withUri($baseUri)
                ->withHeader('Authorization', $headerAuthorization);

            $response = $client->send($baseRequest);
            $status = $response->getStatusCode();
            if (!in_array($status, range(200, 204))) {
                $this->exceptionResponse('Ошибка запроса', Response::HTTP_BAD_GATEWAY);
            }

            $response = json_decode((string)$response->getBody());
        } catch (\Exception $e) {
            $this->exceptionResponse($e->getMessage(), Response::HTTP_BAD_GATEWAY);
        }

        return $response;
    }

}
