<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    public function priceFilter($number)
    {
        $square = $number*$number;

        return $square;
    }

    public function getName()
    {
        return 'app_extension';
    }
}