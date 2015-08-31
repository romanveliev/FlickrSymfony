<?php

namespace First\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FirstFirstBundle:Default:index.html.twig', array('name' => $name));
    }
}
