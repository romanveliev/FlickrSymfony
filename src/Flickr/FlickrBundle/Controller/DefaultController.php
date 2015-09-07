<?php
namespace Flickr\FlickrBundle\Controller;

use Flickr\FlickrBundle\Exceptions\FlickrException;
use Flickr\FlickrBundle\Models\FlickrModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package Flickr\FlickrBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $model = $this->get('flickr_model');

        $photos = $model->getRecentPhotos();
        if ($photos instanceof FlickrException) {
            $msg = $this->get('translator')->trans($photos->message, []);
            return new Response($msg);
        }

        return $this->render('FlickrFlickrBundle:Default:index.html.twig', array('data' => $photos));
    }

}