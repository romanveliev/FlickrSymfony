<?php

namespace Flickr\FlickrBundle\Models;

class FlickrModel
{
    private $query;
    private $array     = [];
    private $sizes     = [];
    private $url       = [];
    private $bigImgUrl = [];
    /**
     * @return array
     */
    public function getRecentPhotos()
    {
        $flickrApi = Flickr::getInstance();
        $this->query = $flickrApi->getQuery();
        $allPhotos = $flickrApi->getCurl($this->query);
        foreach($allPhotos->photos->photo as $firstKey => $photo){
            $this->sizes[] = $this->getSizes($photo->id);
            /**/
            $this->url[] = $this->getUrl( $this->sizes[$firstKey][0]->url );
            foreach ($this->sizes[$firstKey] as $key => $value) {
                if ($value->label === 'Large') {
                    $this->bigImgUrl[$firstKey] = $value->source;
                }
                else if($value->label === 'Original') {
                    $this->bigImgUrl[$firstKey] = $value->source;
                }

            }
        }
        $this->array[0] = $allPhotos->photos->photo;
        $this->array[1] = $this->sizes;
        $this->array[2] = $this->url;
        $this->array[3] = $this->bigImgUrl;
        return $this->array;
    }
    /**
     *@param string $string
     *@return string
     */
    private function getUrl($string)
    {
        $str = explode('/', $string);
        unset($str[6], $str[7], $str[8]);
        $url = implode("/", $str);
        return $url;
    }
    /**
     *@param int $id
     *@return array
     */
    private function getSizes( $id )
    {
        $sizes = file_get_contents(
            ("https://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=863e1a544ee0c20ccd310e198d783065&photo_id=".$id."&format=json&nojsoncallback=1"));
        $allSizes = json_decode($sizes);
        return $allSizes->sizes->size;
    }
}
