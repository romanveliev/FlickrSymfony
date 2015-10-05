<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class DefaultController extends Controller
{
    private $output;
    /**
     * @param Request $request
     * @return mixed
     */
    public function indexAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $translator = $this->get('translator');
            $type = json_decode($request->query->get('type'));
            if($type == 'content'){

                $this->output = ['html' => '',
                                 'data' => [
                                    'header' => $translator->trans('main_page')
                                ]
                ];
                return new JsonResponse($this->output);
            }

            if($type == 'header'){
                $this->output = [
                    '', $translator->trans('main_page')
                ];
                return new JsonResponse($this->output);

            }

        }

        $path = $request->getPathInfo();
        if ($request->attributes->has('path')) {
            $path = $request->attributes->get('path');
        }
        if (!$path) {
            return false;
        }

        $parts = explode("/", $path);
        $locale = strtoupper($parts[1]);


        $allowedLanguages = ['en_US', 'en_GB'];

        $arr ='';
        foreach ($allowedLanguages as $lang ) {
            $oneLang = explode('_', $lang);
            $arr[][$oneLang[0]] = $oneLang[1];
        }

        foreach($arr as $smallArr){
            $findLocale = array_search($locale, $smallArr);
            if($findLocale){
                $newLocale = $findLocale.'_'.$locale;
//                var_dump($newLocale);die();
            }
        }

        dump($arr);

        $parts = explode("/", $path);
        $locale = $parts[1];
//dump($locale);
        // die();

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

