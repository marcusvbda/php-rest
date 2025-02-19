<?php

namespace Test\Functional\Rest;

use GuzzleHttp\Client;
use InvalidArgumentException;
use MyRest\Util\FakeApiRequester;
use MyRest\Util\OpenAIService;

class ChatbotTest extends BaseApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessResponseWithMockedApi(): void
    {
        $clientMock = $this->createMock(OpenAIService::class);
        $clientMock->method('askGPT')
            ->willReturn("This is a mock response");
        $request = new FakeApiRequester($clientMock);
        $request
            ->withPsr7Request($this->getPsr7Request())
            ->withMethod('GET')
            ->withPath("/chatbot/ask?question=lorem&filename=getting_started")
            ->assertResponseCode(200);
        $this->assertRequest($request);
    }

    public function testFailQuestionParamsIsMissing(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $request = new FakeApiRequester(new Client());
        $request
            ->withPsr7Request($this->getPsr7Request())
            ->withMethod('GET')
            ->withPath("/chatbot/ask?filename=getting_started")
            ->assertResponseCode(400);
        $this->assertRequest($request);
    }

    public function testFailFileParamsIsMissing(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $request = new FakeApiRequester();
        $request
            ->withPsr7Request($this->getPsr7Request())
            ->withMethod('GET')
            ->withPath("/chatbot/ask?question=ipsum")
            ->assertResponseCode(400);
        $this->assertRequest($request);
    }

    public function testFailIfFilenameIsIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $request = new FakeApiRequester();
        $request
            ->withPsr7Request($this->getPsr7Request())
            ->withMethod('GET')
            ->withPath("/chatbot/ask?question=lorem&filename=ipsum")
            ->assertResponseCode(400);
        $this->assertRequest($request);
    }
}
