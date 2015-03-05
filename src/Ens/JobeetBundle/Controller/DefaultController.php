<?php

namespace Ens\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	/**
	 * Route(name = "homepage")
	 *
	 */
    public function indexAction($name)
    {
        return $this->render('EnsJobeetBundle:Default:index.html.twig', array('name' => $name));
    }
}
