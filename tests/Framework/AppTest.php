<?php

namespace Tests\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testRedirectTrailingSlash()
    {
        $app = new App();
        $request = new ServerRequest("GET", "/demoslash/");
        $response = $app->run($request);
        $this->assertContains("/demoslash", $response->getHeader("Location"));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testBlog()
    {
        $app = new App();
        $request = new ServerRequest("GET", "/blog");
        $response = $app->run($request);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test404()
    {
        $app = new App();
        $request = new ServerRequest("GET", "/bl");
        $response = $app->run($request);
        $this->assertEquals(404, $response->getStatusCode());
    }
}
