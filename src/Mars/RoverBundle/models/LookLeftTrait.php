<?php
namespace Mars\RoverBundle\models;


trait LookLeftTrait
{
    /**
     * @var string $direction
     */
    private $leftDirection;
    /**
     * @param $key
     * @param $length
     * @return string
     */
    private function lookLeft($key, $length)
    {
        if ($key - 1 < 0) {
            $this->leftDirection = $this->array[$length - 1];
            return $this->leftDirection;
        } else {
            $this->leftDirection = $this->array[$key - 1];
            return $this->leftDirection;
        }
    }
}