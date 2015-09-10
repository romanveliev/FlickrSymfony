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
     * @return mixed
     */
    abstract public function move();
}