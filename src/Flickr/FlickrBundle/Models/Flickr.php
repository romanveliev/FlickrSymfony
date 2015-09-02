<?php

namespace Flickr\FlickrBundle\Models;
class Flickr{
    use CurlTrait;

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

    private function __construct(){}
    private function __clone(){}
}