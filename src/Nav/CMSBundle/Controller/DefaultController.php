<?php

namespace Nav\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NavCMSBundle:Default:index.html.twig');
    }
}
