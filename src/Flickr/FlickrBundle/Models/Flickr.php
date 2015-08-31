<?php

namespace Flickr\FlickrBundle\Models;

class Flickr{
    use CurlTrait;
    private $query = "https://api.flickr.com/services/rest/?method=flickr.photos.getRecent&api_key=863e1a544ee0c20ccd310e198d783065&per_page=10&format=json&nojsoncallback=1";

    private static $variable;
    /**
     * @return Flickr
     */
    public static function getInstance(){
        if(empty(self::$variable)){
            self::$variable = new Flickr();
        }
        return self::$variable;
    }
    /**
     * @return string
     */
    public function getQuery(){
        return $this->query;
    }
    public static function redirect($url){
        header("Status: 200 OK");
        header("Location: ".index.$url);
    }
    private function __construct(){}
    private function __clone(){}
}