<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @dataProvider getPublicUrls
     */
    public function testPublicUrls(string $url)
    {
        $this->client->request('GET', $url);

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider getSecureUrls
     */
    public function testSecureUrls(string $url)
    {
        $this->client->request('GET', $url);

        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_FOUND, $response->getStatusCode());
        $this->assertSame('http://localhost.mediamonks-demo.com/login', $response->getTargetUrl());
    }



    public function getPublicUrls()
    {
        yield ['/login'];
        //yield ['/connect/google'];
    }

    public function getSecureUrls()
    {
        yield ['/post'];
        // yield ['/admin'];
        // yield ['/admin/app/post/list'];
        // yield ['/admin/app/comment/list'];
        // yield ['/admin/app/user/list'];
        // yield ['/admin/app/tag/list'];
    }
}
