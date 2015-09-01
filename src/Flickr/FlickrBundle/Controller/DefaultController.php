<?php

namespace Flickr\FlickrBundle\Controller;

use Flickr\FlickrBundle\Exceptions\FlickrException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Flickr\FlickrBundle\Models\FlickrModel;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $FlickrRecentPhotos = $this->container->getParameter('FlickrRecentPhotos');
        $model = new FlickrModel($FlickrRecentPhotos);
        $photos = $model->getRecentPhotos();

        if($photos instanceof FlickrException){
            $msg = $this->get('translator')->trans($photos->message);
            return new Response($msg);
        }

        return $this->render('FlickrFlickrBundle:Default:index.html.twig', array('data' => $photos));
    }

}