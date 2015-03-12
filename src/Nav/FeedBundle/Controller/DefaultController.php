<?php

namespace Nav\FeedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Client;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $pages = $this->getDoctrine()->getRepository('NavCMSBundle:Page')->findAll();

        // TODO: Take feed as param, return object
        foreach ($pages as $page) {
            $result = $this->processFeed($page->getFeed());
        }

        echo '<pre>';
        var_dump($result);
        exit;

    }


    public function processFeed($feedUrl)
    {
        $client = new Client();
        $response = $client->get("http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&q=" . $feedUrl)->json(['object'=>true]);
        return $response->responseData->feed;
    }



}
