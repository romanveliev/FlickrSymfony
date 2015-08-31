<?php
namespace Flickr\FlickrBundle\Models;
use Flickr\FlickrBundle\config;


class FlickrException extends \Exception{
    protected $message;
    function __construct($code){
        if($code == 100){
            $this->message = "The API key passed was not valid or has expired.";
        }

        parent::__construct($this->message);
    }
}