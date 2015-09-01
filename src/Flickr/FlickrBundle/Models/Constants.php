<?php
namespace Flickr\FlickrBundle\Models;

class Constants{

    const FlickrRecentPhotos = 'https://api.flickr.com/services/rest/?method=flickr.photos.getRecent&api_key=s863e1a544ee0c20ccd310e198d783065&per_page=10&format=json&nojsoncallback=1';


    /**
     * Flickr ERRORS
     */
    const InvalidAPIKey = 100;
    const ServiceCurrentlyUnavailable = 105;
    const WriteOperationFailed = 106;
    const FormatNotFound = 111;
    const MethodNotFound = 112;
    const InvalidSoap = 114;
    const InvalidXml = 115;
    const BadUrlFound = 116;
}