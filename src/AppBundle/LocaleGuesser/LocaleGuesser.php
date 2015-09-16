<?php
namespace AppBundle\LocaleGuesser;

use Symfony\Component\HttpFoundation\Request;
use Lunetics\LocaleBundle\LocaleGuesser\LocaleGuesserInterface;
use Lunetics\LocaleBundle\Validator\MetaValidator;

class LocaleGuesser implements LocaleGuesserInterface
{

    private $identifiedLocale;

    private $metaValidator;

    public function guessLocale(Request $request)
    {
        // Code to identify the locale, if found:
        $this->metaValidator = new MetaValidator();
        if ($this->metaValidator->isAllowed('ru')) {
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