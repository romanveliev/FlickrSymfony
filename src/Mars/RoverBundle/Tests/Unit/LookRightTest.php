<?php
namespace Mars\RoverBundle\Tests\Unit;


use Mars\RoverBundle\models\Rover;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LookRightTest extends WebTestCase{

    private $array = ['N', 'E', 'S', 'W'];

    /**
     * @param $coordinates
     * @param $expected
     * @dataProvider provider
     */
    public function testLook($coordinates, $expected){
        $model = new Rover($coordinates, "R", [5,5]);

        $length = count($this->array);
        $key = array_search($model->getDirection(), $this->array);
        $right = $model->lookRight($key,$length);

        $this->assertEquals($expected, $right);
    }

    public function provider(){
        return [
            ['1 4 S', 'W'],
            ['1 4 N', 'E'],
        ];
    }

}