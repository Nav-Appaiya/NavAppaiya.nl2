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

        $twitterClient = $this->get('guzzle.twitter.client');

        $request = $twitterClient->post('statuses/update.json', null, array(
            'status'=> 'Working on a new Feed to aggregate from, maintenance mode!'
        ));


        $data = $request->send()->json();
        var_dump($data);exit;

    }

}
