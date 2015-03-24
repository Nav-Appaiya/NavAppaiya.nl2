<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 24-3-2015
 * Time: 1:19
 *
 * Youtube downloader Controller
 * - Render form
 * - Take postdata
 * - Process and return download
 */

namespace Nav\CMSBundle\Controller;

use Nav\CMSBundle\Entity\Youtube;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Nav\CMSBundle\Externals\PhpTube;

class YoutubeController extends Controller
{

    public function indexAction(Request $request) {

        $tube = new PhpTube();
        var_dump($tube->getDownloadLinks(["https://www.youtube.com/watch?v=uBRhI4Rn7hQ"]));

        exit;
        $youtube = new Youtube();
        $form = $this->createFormBuilder($youtube)
            ->add('url', 'text', array('label' => 'Youtube'))
            ->add('download', 'submit', array(
                'label' => 'Get Download',
                'attr' => array('class' => 'btn btn-danger btn-sm')
            ))->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $youtube->setRequestedIp($this->get('request')->getClientIp());
            $youtube->setComputerName($this->get('request')->getHost());
            $em->persist($youtube);
            $em->flush();
            $notify = $this->get('nav.notification');
            $notify->add('notification', ['title'=>'Success', 'message'=>'Done!']);
            return $this->redirect($this->generateUrl('nav_youtube'));
        }
        return $this->render('NavCMSBundle:Media:youtube.html.twig', [
            'form' => $form->createView()
        ]);
    }



}