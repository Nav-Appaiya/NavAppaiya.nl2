<?php

namespace Nav\ScraperBundle\Controller;

use Guzzle\Service\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        die('NavScraperBundle');
    }

    /**
     * @param $url
     * Url as parameter
     * Returns json result of feed
     */
    public function feedBurnerURL($url)
    {
        $client = new Client();
        $result = $client->get("http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=100&q=".$url)->send();

        return $result;
    }
}
