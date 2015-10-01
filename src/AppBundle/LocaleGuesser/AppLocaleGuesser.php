<?php
namespace AppBundle\LocaleGuesser;

use Lunetics\LocaleBundle\LocaleGuesser\AbstractLocaleGuesser;
use Lunetics\LocaleBundle\Validator\MetaValidator;
use Symfony\Component\HttpFoundation\Request;
use Lunetics\LocaleBundle\LocaleInformation\AllowedLocalesProvider;



class AppLocaleGuesser extends AbstractLocaleGuesser
{
    private $metaValidator;
    private $allowedLocales;
    private $foundLocale;

    public function __construct(MetaValidator $metaValidator, $allowedLocales)
    {
        $this->metaValidator = $metaValidator;
        $this->allowedLocales = $allowedLocales;
    }
    /**
     *
     * @param Request $request
     *
     * @return boolean True if locale is detected
     */
    public function guessLocale(Request $request)
    {
        $localeValidator = $this->metaValidator;
        $path = $request->getPathInfo();
        if ($request->attributes->has('path')) {
            $path = $request->attributes->get('path');
        }
        if (!$path) {
            return false;
        }

        $parts = explode("/", $path);
        $locale = strtoupper($parts[1]);


        $arr ='';
        foreach ($this->allowedLocales as $lang ) {
            $oneLang = explode('_', $lang);
            if(isset($oneLang[1])){
                $arr[][$oneLang[0]] = $oneLang[1];
            }else {
                $arr[][$oneLang[0]] = '';
            }
        }

        foreach($arr as $smallArr){
            $findLocale = array_search($locale, $smallArr);
            if($findLocale){
                $locale = $findLocale.'_'.$locale;
            }
        }


        if ($localeValidator->isAllowed($locale)) {
            $this->identifiedLocale = $locale;
            return $this->identifiedLocale;
        }
        return false;
    }

    public function getIdentifiedLocale()
    {
        return $this->identifiedLocale;
    }
}