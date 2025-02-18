<?php

namespace MyRest\Rest;

use ByJG\RestServer\Exception\Error400Exception;
use ByJG\RestServer\HttpRequest;
use ByJG\RestServer\HttpResponse;
use MyRest\Util\OpenAIService;
use OpenApi\Attributes as OA;

class ChatbotRest
{
    private OpenAIService $service;

    public function __construct()
    {
        $this->service = new OpenAIService();
    }

    /**
     * Ask the chatbot a question based on a specific document.
     *
     * @param HttpResponse $response
     * @param HttpRequest $request
     */
    #[OA\Get(
        path: "/chatbot/ask",
        parameters: [
            new OA\Parameter(
                name: "question",
                in: "query",
                required: true,
                schema: new OA\Schema(type: "string")
            ),
            new OA\Parameter(
                name: "filename",
                in: "query",
                required: true,
                schema: new OA\Schema(
                    type: "string",
                    enum: [
                        "getting_started",
                        "getting_started_01_create_table",
                        "getting_started_02_add_new_field",
                        "getting_started_03_create_rest_method"
                    ]
                )
            )
        ]
    )]
    #[OA\Response(
        response: 200,
        description: "The chatbot's response",
        content: new OA\JsonContent(
            required: ["answer"],
            properties: [
                new OA\Property(property: "answer", type: "string", format: "string")
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: "Invalid request parameters",
        content: new OA\JsonContent(
            required: ["error"],
            properties: [
                new OA\Property(property: "error", type: "string", format: "string")
            ]
        )
    )]
    public function ask(HttpResponse $response, HttpRequest $request): void
    {
        $question = $request->get("question");
        $filename = $request->get("filename");

        $validFilenames = [
            "getting_started",
            "getting_started_01_create_table",
            "getting_started_02_add_new_field",
            "getting_started_03_create_rest_method"
        ];

        if (empty($question) || empty($filename)) {
            throw new Error400Exception("Os parâmetros 'question' e 'filename' são obrigatórios.");
        }

        if (!in_array($filename, $validFilenames, true)) {
            throw new Error400Exception("O parâmetro 'filename' é inválido.");
        }

        $answer = $this->service->askGPT($question, $filename);
        $response->write(["answer" => $answer]);
    }
}
