<?php

namespace Test\Functional\Rest;

use ByJG\RestServer\Exception\Error401Exception;
use ByJG\RestServer\Exception\Error403Exception;
use ByJG\Serializer\BinderObject;
use MyRest\Util\FakeApiRequester;
use MyRest\Model\ExampleCrud;
use MyRest\Repository\BaseRepository;

class HelloWorldTest extends BaseApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return HelloWorldTest|array
     */

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
