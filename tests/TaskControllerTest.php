<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('example-wrapper', $crawler->filter('div')->attr('class'));
        $this->assertEquals('table', $crawler->filter('div')->children()->first()->nodeName());
    }
}
