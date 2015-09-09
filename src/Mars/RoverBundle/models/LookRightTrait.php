<?php
namespace Mars\RoverBundle\models;


trait LookRightTrait
{
    /**
     * @var string $direction
     */
    private $rightDirection;
    /**
     * @param $key
     * @param $length
     * @return string
     */
    public function lookRight($key, $length)
    {
        if ($key + 1 > $length - 1) {
            $this->rightDirection = $this->array[0];
            return $this->rightDirection;
        } else {
            $this->rightDirection = $this->array[$key + 1];
            return $this->rightDirection;
        }
    }
}