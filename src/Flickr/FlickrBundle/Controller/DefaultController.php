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


        if ($request->isXMLHttpRequest()) {
            $translator = $this->get('translator');
            $type = json_decode($request->query->get('type'));
            if($type == 'content'){

                $smth = '<img src="" id="big"><div id="none" ></div><table border="1">';
                foreach($photos['allPhotos'] as $key => $photo){
                    $smth .= '<tr class="click"><td><img src='.$photos["sizes"][$key][0]->source.' foo='.$photos['bigPhotoUrl'][$key].'></td><td><p>'.$photo->title.'</p></td><td><a href='.$photos['url'][$key].'></td>';
                }

                $this->output = [
                    $smth, $translator->trans('flickr_project')
                ];

                return new JsonResponse($this->output);
            }

            if($type == 'header'){
                $this->output = [
                    '<p>HEADER FLICKR</p>', $translator->trans('flickr_project')
                ];
                return new JsonResponse($this->output);

            }

        }


        return $this->render('FlickrFlickrBundle:Default:index.html.twig', array('data' => $photos));
    }

}