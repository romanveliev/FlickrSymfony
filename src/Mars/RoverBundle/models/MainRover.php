<?php
namespace Mars\RoverBundle\models;

/**
 * Class Rover
 */
abstract class MainRover{
    /**
     * @return mixed
     */
    abstract public function changeDirection();
    /**
     * @param $direction
     * @return mixed
     */
    abstract public function move($direction);
}