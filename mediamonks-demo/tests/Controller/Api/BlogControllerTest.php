<?php

namespace App\Tests\Controller\Api;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BlogControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testIndex()
    {
        $post = $this->client->getContainer()->get('doctrine')->getRepository(Post::class)->findAll();
        $this->client->request('GET', '/api/blogs');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThanOrEqual(0, count($post));
    }

    public function testShow()
    {
        $id = 1;
        $post = $this->client->getContainer()->get('doctrine')->getRepository(Post::class)->find($id);
        $this->client->request('GET', "/api/blogs/{$id}");

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThanOrEqual(0, count($post));
    }

}
