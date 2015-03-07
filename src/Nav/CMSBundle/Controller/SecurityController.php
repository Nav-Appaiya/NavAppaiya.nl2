<?php
namespace Nav\CMSBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        // Please note that Symfony 2.6 uses the
        // security.authentication_utils service + AuthenticationUtils class
        // in the loginActionController. This is the Symfony 2.3 way of the loginController.

        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = null;
        }

        // This is for when user failed login,
        // the input will be filled in for second try
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

}