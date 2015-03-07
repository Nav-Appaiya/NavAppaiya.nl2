<?php

namespace Nav\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('NavCMSBundle:Page')->findAll();

        return $this->render('NavCMSBundle:Default:index.html.twig', array(
            'pages' => $pages
        ));
    }
}
