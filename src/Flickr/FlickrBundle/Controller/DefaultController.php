<?php

namespace Flickr\FlickrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Flickr\FlickrBundle\Models\FlickrModel;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $model = new FlickrModel();
        $photos = $model->getRecentPhotos();

        return $this->render('FlickrFlickrBundle:Default:index.html.twig', array('data' => $photos));
    }

}