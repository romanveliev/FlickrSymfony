<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function indexAction(Request $request)
    {


        return $this->render('AppBundle:Default:index.html.twig');

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxAction(Request $request){
        $translator = $this->get('translator');
        if ($request->isXMLHttpRequest()) {

            $_locale = $request->attributes->get('_locale', $request->getLocale());

            $output = [
                        "/".$_locale."" =>$translator->trans("main"),
                        "/".$_locale."/mars" =>$translator->trans("mars"),
                        "/".$_locale."/flickr" => $translator->trans("flickr"),
                    ];
            return new JsonResponse($output);
        }
        return new JsonResponse('json response', 500);
    }
}

