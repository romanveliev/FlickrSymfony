<?php
namespace Flickr\FlickrBundle\Models;
use Flickr\FlickrBundle\Exceptions\FlickrException;

trait CurlTrait{
    /**
     * @return mixed
     */
    public function getCurl($url)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_HEADER, 0);
        $output = curl_exec($c);
        curl_close($c);
        $allPhotos = json_decode($output);
        try{
            if(isset($allPhotos->code)){
                throw new FlickrException($allPhotos->code);
            }
        }catch (FlickrException $e){
            echo $e->getMessage();
            die();
        }
        return $allPhotos;
    }
}