<?php

namespace Test\Functional\Rest;

use MyRest\Util\FakeApiRequester;

class HelloWorldTest extends BaseApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testGetResult()
    {
        $request = new FakeApiRequester();
        $request
            ->withPsr7Request($this->getPsr7Request())
            ->withMethod('GET')
            ->withPath("/hello")
            ->assertResponseCode(200)
        ;
        $body = $this->assertRequest($request);
        $bodyAr = json_decode($body->getBody()->getContents(), true);
        $this->assertEquals('world', $bodyAr['result']);
    }
}
