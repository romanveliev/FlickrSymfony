<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajax", name="_ajax")
     */
    public function ajaxAction(Request $request){
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse('<ul><li>item 1</li><li>item 2</li></ul>');
        }
        return new Response('json response');
    }
}
