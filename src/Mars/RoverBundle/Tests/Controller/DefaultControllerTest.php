<?php

namespace Mars\RoverBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/flickr');

        $this->assertTrue($crawler->filter('a:contains("Mars")')->count() > 0);
    }

    public function testMars()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/mars/');


        $this->assertTrue($crawler->filter('a:contains("Mars")')->count() > 0);
    }
}
