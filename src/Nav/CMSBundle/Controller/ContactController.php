<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 8-3-2015
 * Time: 0:28
 */

namespace Nav\CMSBundle\Controller;


use Nav\CMSBundle\Entity\Contact;
use Nav\CMSBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller{

    public function indexAction()
    {

        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);

        return $this->render('NavCMSBundle:Default:contact.html.twig', [
            'form'=> $form->createView()
        ]);
    }

}