<?php

namespace Nav\CMSBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TestController extends Controller
{
    public function indexAction()
    {

        $client = new Client();

        $response = $this->feedBurner('http://feeds.feedburner.com/technieuws/nav');

        echo '<pre>';

        var_dump($response->entries[0]);

        exit;
    }

    public function feedBurner($feedUrl)
    {
        $client = new Client();
        $response = $client->get("http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&q=" . $feedUrl)->json(['object'=>true]);
        return $response->responseData->feed;
    }

}
