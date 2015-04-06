<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 8-3-2015
 * Time: 0:28
 */

namespace Nav\CMSBundle\Controller;


use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller{

    public function indexAction() {
        $codeschool = "http://backpack.openbadges.org/displayer/160839/group/53555.json";

        $response = json_decode(file_get_contents($codeschool));
        $badges = $response->badges;


        return $this->render('NavCMSBundle:Default:about.html.twig', [
            'badges' => $badges
        ]);
    }

}