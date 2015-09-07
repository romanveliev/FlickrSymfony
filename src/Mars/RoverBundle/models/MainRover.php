<?php
namespace Mars\RoverBundle\models;

/**
 * Class Rover
 */
abstract class MainRover{
    /**
     * @param $direction
     * @return mixed
     */
    abstract protected function changeDirection($direction);
    /**
     * @param $direction
     * @return mixed
     */
    abstract protected function move($direction);
}