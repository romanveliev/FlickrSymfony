<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/ajax", name="_ajax")
     */
    public function ajaxAction(Request $request){
        $translator = $this->get('translator');
        if ($request->isXMLHttpRequest()) {
            $output = [
                        "/" =>$translator->trans("main"),
                        "/mars" =>$translator->trans("mars"),
                        "/flickr" => $translator->trans("flickr"),
                    ];
            return new JsonResponse($output);
        }
        return new JsonResponse('json response', 500);
    }
}

