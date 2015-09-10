<?php
namespace Mars\RoverBundle\Tests\Unit;


use Mars\RoverBundle\models\Rover;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoverMoveTest extends WebTestCase{

    /**
     * @param $coordinate
     * @param $move
     * @param $upperRight
     * @param $direction
     * @param $expected
     * @throws \Mars\RoverBundle\Exceptions\MarsException
     * @dataProvider provider
     */
    public function testMove($coordinate, $move, $upperRight, $direction, $expected){

        $model = new Rover($coordinate, $move, $upperRight);
        $model->move($direction);
        $str = $model->getX().' '.$model->getY().' '.$model->getDirection();
        $this->assertEquals($expected, $str);

    }

    public function provider(){
        return [
            ['1 2 N', 'M', [5,5], 'N', '1 3 N'],
        ];
    }

}