<?php

namespace Mars\RoverBundle\Tests\Controller;

use Mars\RoverBundle\models\Rover;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainRoverTest extends WebTestCase
{
    private $model;
    private $x;
    private $y;
    private $direction;
    private $str;

    /**
     * @param $a
     * @param $b
     * @param $upperRightCoordinates
     * @param $expected
     * @dataProvider provider
     */
    public function testCompare($a, $b, $upperRightCoordinates, $expected)
    {
        $this->model = new Rover($a,$b, $upperRightCoordinates);
        $data[] = $this->model->changeDirection();

        $this->x = $this->model->getX();
        $this->y = $this->model->getY();
        $this->direction = $this->model->getDirection();
        $this->str = $this->x.' '.$this->y.' '.$this->direction;
        $this->assertEquals($expected, $this->str);
    }

    /**
     * @return array
     */
    public function provider()
    {
        return array(
            array('1 2 N', 'M', [5, 5], '1 3 N'),
            array('3 3 E', 'M', [5, 5], '4 3 E'),
            array('1 1 N', 'M', [5, 5], '1 2 N'),
            array('1 0 N', 'RRM', [5, 5], '1 3 N'),
        );
    }
}