<?php

namespace Test\Functional\Rest;

use ByJG\RestServer\Exception\Error400Exception;
use MyRest\Util\FakeApiRequester;

class ChatbotTest extends BaseApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testFailQuestionParamsIsMissing(): void
    {
        $this->expectException(Error400Exception::class);
        $request = new FakeApiRequester();
        $request
            ->withPsr7Request($this->getPsr7Request())
            ->withMethod('GET')
            ->withPath("/chatbot/ask?filename=ipsum")
            ->assertResponseCode(400);
        $this->assertRequest($request);
    }

    public function testFailFileParamsIsMissing(): void
    {
        $this->expectException(Error400Exception::class);
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
        $this->expectException(Error400Exception::class);
        $request = new FakeApiRequester();
        $request
            ->withPsr7Request($this->getPsr7Request())
            ->withMethod('GET')
            ->withPath("/chatbot/ask?question=lorem&filename=ipsum")
            ->assertResponseCode(400);
        $this->assertRequest($request);
    }
}
