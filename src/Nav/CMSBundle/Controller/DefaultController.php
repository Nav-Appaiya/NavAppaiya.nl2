<?php

namespace Nav\CMSBundle\Controller;

use Guzzle\Http\Client;
use Nav\CMSBundle\Entity\Visitor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction() {
        $this->track();
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('NavCMSBundle:Page')->findAll();

        return $this->render('NavCMSBundle:Default:index.html.twig', array(
            'pages' => $pages
        ));
    }

    public function displayAction($id) {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('NavCMSBundle:Page')->find($id);

        // Get the articles
        $feedburner = $this->get('scraper.feedburner');
        $feedburner->loadFeed($page->getFeed());

        return $this->render('NavCMSBundle:Default:display.html.twig', array(
            'page'      => $page,
            'articles'  => $feedburner->getEntries()
        ));
    }

    private function track()
    {
        $host   = gethostname();
        $ip     = $this->get('request')->getClientIp();
        $path   = $this->getRequest()->getRequestUri();
        $info   = $this->get('request')->getPathInfo();

        $visitor = new Visitor();
        $visitor->setHostname($host);
        $visitor->setIp($ip);
        $visitor->setPath($path);
        $visitor->setInfo($info);

        $em = $this->getDoctrine()->getManager();
        $em->persist($visitor);
        $em->flush();
    }

}
