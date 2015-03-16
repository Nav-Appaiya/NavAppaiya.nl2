<?php

namespace Nav\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\True;

class TestController extends Controller
{
    public function indexAction()
    {
        $scraper = $this->get('scraper.default_controller');
        $resultJson = $scraper->feedBurnerURL("http://feeds.feedburner.com/tweakers/mixed");

        echo '<pre>';

        var_dump($resultJson->json(['object' => true]));

        exit;
    }

    public function feedBurner($feedUrl)
    {
        $client = new Client();
        $response = $client->get("http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&q=" . $feedUrl)->json(['object'=>true]);
        return $response->responseData->feed;
    }

    public function notification()
    {
        $notifications = $this->get('nav.notification');

        $notifications->add("test1", array("type" => "instant", "message" => "This is awesome"));
        $notifications->add("test2", array("type" => "instant", "message" => "This is awesome"));

        return $this->render('NavNotificationBundle:Notifications:success.html.twig', [
            'notifications'=>$notifications
        ]);
    }

    public function tweeter()
    {

        $twitter = $this->get('guzzle.twitter.client');
        $status = $twitter->post('statuses/update.json',null,  ['status'=> '1jasdoifjasoidjfoaisdjf'])
            ->send()->json();

        return $this->render('@NavCMS/Default/test.html.twig', array(
            'status' => $status
        ));
    }

}
