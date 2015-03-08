<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 8-3-2015
 * Time: 0:28
 */

namespace Nav\CMSBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller{

    public function indexAction() {

        return $this->render('NavCMSBundle:Default:about.html.twig');
    }

}