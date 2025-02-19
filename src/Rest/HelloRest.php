<?php

namespace MyRest\Rest;

use ByJG\RestServer\HttpRequest;
use ByJG\RestServer\HttpResponse;
use OpenApi\Attributes as OA;

class HelloRest
{
    /**
     * Hello word
     *
     * @param HttpResponse $response
     * @param HttpRequest $request
     */
    #[OA\Get(
        path: "/hello",
    )]
    #[OA\Response(
        response: 200,
        description: "The object",
        content: new OA\JsonContent(
            required: ["result"],
            properties: [
                new OA\Property(property: "result", type: "string")
            ]
        )
    )]
    public function getPing(HttpResponse $response, HttpRequest $request)
    {
        $response->write([
            'result' => 'world'
        ]);
    }
}
