<?php
namespace Flickr\FlickrBundle\Controller;

use Flickr\FlickrBundle\Exceptions\FlickrException;
use Flickr\FlickrBundle\Models\FlickrModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package Flickr\FlickrBundle\Controller
 */
class DefaultController extends Controller
{
    private $content;
    private $output;
    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function indexAction(Request $request)
    {
        $model = $this->get('flickr_model');

        $photos = $model->getRecentPhotos();
        if ($photos instanceof FlickrException) {
            $msg = $this->get('translator')->trans($photos->message, []);
            return new Response($msg);
        }


        /** ajax response */
        if ($request->isXMLHttpRequest()) {
            $translator = $this->get('translator');
            $type = json_decode($request->query->get('type'));
            if($type == 'content'){
                $this->content = $this->renderView('FlickrFlickrBundle:ajax:gallery.html.twig',
                    ['data' => $photos ]
                );

                $this->output = ['html' => $this->content,
                    'data' => [
                        'header' => $translator->trans('flickr_project')
                    ]
                ];
                return new JsonResponse($this->output);
            }
        }

        return $this->render('FlickrFlickrBundle:Default:index.html.twig', ['data' => $photos]);
    }

}