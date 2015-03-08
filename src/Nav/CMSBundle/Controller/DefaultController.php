<?php

namespace Nav\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('NavCMSBundle:Page')->findAll();

        return $this->render('NavCMSBundle:Default:index.html.twig', array(
            'pages' => $pages
        ));
    }

    public function displayAction($id) {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('NavCMSBundle:Page')->find($id);

        return $this->render('NavCMSBundle:Default:display.html.twig', array(
           'page' => $page
        ));
    }
}
