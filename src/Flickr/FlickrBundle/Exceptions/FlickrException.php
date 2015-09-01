<?php
namespace Flickr\FlickrBundle\Exceptions;

use Flickr\FlickrBundle\Models\Constants;

class FlickrException extends \Exception{
    public $message;
    function __construct($code){
        if($code == Constants::InvalidAPIKey){
            $this->message = "The API key passed was not valid or has expired.";
        }
        if($code == Constants::ServiceCurrentlyUnavailable){
            $this->message = "The requested service is temporarily unavailable.";
        }
        if($code == Constants::WriteOperationFailed){
            $this->message = "The requested operation failed due to a temporary issue.";
        }
        if($code == Constants::FormatNotFound){
            $this->message = "The requested response format was not found.";
        }
        if($code == Constants::MethodNotFound){
            $this->message = "The requested method was not found.";
        }
        if($code == Constants::InvalidSoap){
            $this->message = "The SOAP envelope send in the request could not be parsed.";
        }
        if($code == Constants::InvalidXml){
            $this->message = "The XML-RPC request document could not be parsed.";
        }
        if($code == Constants::BadUrlFound){
            $this->message = "One or more arguments contained a URL that has been used for abuse on Flickr.";
        }

        parent::__construct($this->message);
    }
}