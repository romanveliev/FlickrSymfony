<?php

namespace Mars\RoverBundle\Tests\Controller;



use Mars\RoverBundle\models\Rover;

class MainRoverTest extends \PHPUnit_Framework_TestCase
{
    private $model;
    private $x;
    private $y;
    private $direction;
    private $str;
    /**
     * @param $a
     * @param $b
     * @param $c
     * @param $d
     * @dataProvider provider
     */
    public function testCompare($a, $b, $c, $d)
    {
        $this->model = new Rover($a,$b,$c);
        $this->x = $this->model->getX();
        $this->y = $this->model->getY();
        $this->direction = $this->model->getDirection();
        $this->str = $this->x.' '.$this->y.' '.$this->direction;
        $this->assertEquals($d, $this->str);
    }
    public function provider()
    {
        return array(
            array('1 2 N', 'M', array(5,5), '1 3 N'),
            array('3 3 E', 'M', array(5,5), '4 3 E'),
            array('1 1 N', 'M', array(5,5), '1 1 N'),
        );
    }
}