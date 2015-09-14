<?php
namespace Flickr\FlickrBundle\Models;

use Flickr\FlickrBundle\Exceptions\FlickrException;

/**
 * Class FlickrModel
 * @package Flickr\FlickrBundle\Models
 */
class FlickrModel
{
    private $query;
    private $array     = [];
    private $sizes     = [];
    private $url       = [];
    private $bigImgUrl = [];

    function __construct($FlickrRecentPhotos){
        $this->query = $FlickrRecentPhotos;
    }


    /**
     * @return array|\Exception|FlickrException
     */
    public function getRecentPhotos()
    {
        $flickrApi = Flickr::getInstance();
        $allPhotos = $flickrApi->getCurl($this->query);
        try{
            if(isset($allPhotos->code)){
                throw new FlickrException($allPhotos->code );
            }
        }catch (FlickrException $e){
            return $e;
        }

        foreach($allPhotos->photos->photo as $firstKey => $photo){
            $this->sizes[] = $this->getSizes($photo->id);
            /**/
            $this->url[] = $this->getUrl( $this->sizes[$firstKey][0]->url );
            foreach ($this->sizes[$firstKey] as $key => $value) {
                if ($value->label === 'Large') {
                    $this->bigImgUrl[$firstKey] = $value->source;
                }if ($value->label === 'Original') {
                    $this->bigImgUrl[$firstKey] = $value->source;
                }
                else if($value->label === 'Medium') {
                    $this->bigImgUrl[$firstKey] = $value->source;
                }

            }
        }


        $this->array['allPhotos'] = $allPhotos->photos->photo;
        $this->array['sizes'] = $this->sizes;
        $this->array['url'] = $this->url;
        $this->array['bigPhotoUrl'] = $this->bigImgUrl;
        return $this->array;
    }

    /**
     * @param $string
     * @return string
     */
    private function getUrl($string)
    {
        $str = explode('/', $string);
        unset($str[6], $str[7], $str[8]);
        $url = implode("/", $str);
        return $url;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getSizes( $id )
    {
        $sizes = file_get_contents(
            ("https://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=863e1a544ee0c20ccd310e198d783065&photo_id=".$id."&format=json&nojsoncallback=1"));
        $allSizes = json_decode($sizes);
        return $allSizes->sizes->size;
    }
}
