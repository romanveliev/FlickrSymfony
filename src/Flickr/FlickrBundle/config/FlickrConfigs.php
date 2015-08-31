<?php
namespace Flickr\FlickrBundle\config;


/**
 * App configs
 */
define("ViewPath","../src/views/template/");
define("index","http://test.dev/");
define("FlickrRecentPhotos","https://api.flickr.com/services/rest/?method=flickr.photos.getRecent&api_key=863e1a544ee0c20ccd310e198d783065&per_page=10&format=json&nojsoncallback=1");
/**
 * Flickr ERRORS
 */
define("InvalidAPIKey",100);
define("ServiceCurrentlyUnavailable",105);
define("WriteOperationFailed",106);
define("FormatNotFound",111);
define("MethodNotFound",112);
define("InvalidSoap",114);
define("InvalidXml",115);
define("BadUrlFound",116);
/**
 *App ERRORS
 */
define("FileExistError"," File doesn't exist.");
define("FileEmptyError"," File is empty.");