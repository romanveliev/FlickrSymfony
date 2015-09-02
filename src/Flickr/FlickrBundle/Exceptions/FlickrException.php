<?php
namespace Flickr\FlickrBundle\Exceptions;

/**
 * Class FlickrException
 * @package Flickr\FlickrBundle\Exceptions
 */
class FlickrException extends \Exception{
    /** @var int  */
    public $message;
    function __construct($code){

        if($code == 100){
            $this->message = 100;
        }
        if($code == 105){
            $this->message = 105;
        }
        if($code == 106){
            $this->message = 106;
        }
        if($code == 111){
            $this->message = 111;
        }
        if($code == 112){
            $this->message = 112;
        }
        if($code == 114){
            $this->message = 114;
        }
        if($code == 115){
            $this->message = 115;
        }
        if($code == 116){
            $this->message = 116;
        }

        parent::__construct($this->message);
    }

}