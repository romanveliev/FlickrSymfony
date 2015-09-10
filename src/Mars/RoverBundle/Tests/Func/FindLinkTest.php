<?php

namespace Mars\RoverBundle\Tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindLinkTest extends WebTestCase
{
    public function testIndex()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/flickr');

        $this->assertTrue($crawler->filter('a:contains("Mars")')->count() > 0);
    }


}
