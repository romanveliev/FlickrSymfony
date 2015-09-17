<?php
namespace AppBundle\LocaleGuesser;

use Lunetics\LocaleBundle\LocaleGuesser\AbstractLocaleGuesser;
use Lunetics\LocaleBundle\Validator\MetaValidator;
use Symfony\Component\HttpFoundation\Request;



class AppLocaleGuesser extends AbstractLocaleGuesser
{
    private $metaValidator;

    public function __construct(MetaValidator $metaValidator)
    {
        $this->metaValidator = $metaValidator;
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
        $foundLocale = $parts[1];


        $allowedLanguages = ['en_EN', 'en_GB'];



        if ($localeValidator->isAllowed($foundLocale)) {
            $this->identifiedLocale = $foundLocale;
            return $this->identifiedLocale;
        }
        return false;
    }

    public function getIdentifiedLocale()
    {
        return $this->identifiedLocale;
    }
}