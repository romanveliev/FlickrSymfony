<?php

namespace First\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
    public function indexAction()
    {
//        return new Response('yo');
        return $this->render('FirstFirstBundle:Hello:index.html.twig', ['data'=>" it's my data"]);
    }

}