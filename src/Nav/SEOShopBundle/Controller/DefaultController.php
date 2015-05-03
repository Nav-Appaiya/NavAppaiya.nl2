<?php

namespace Nav\SEOShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NavSEOShopBundle:Default:index.html.twig');
    }
}
