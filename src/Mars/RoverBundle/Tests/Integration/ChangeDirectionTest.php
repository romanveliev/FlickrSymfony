<?php

namespace Mars\RoverBundle\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ChangeDirectionTest
 * @package Mars\RoverBundle\Tests\Controller
 */
class ChangeDirectionTest extends WebTestCase
{
    /**
     * @param $coordinates
     * @param $instructions
     * @param $upperRightCoordinates
     * @param $returnValue
     * @param $expected
     * @dataProvider provider
     */
    public function testIndex($coordinates, $instructions, $upperRightCoordinates, $returnValue, $expected)
    {
        $mock = $this->getMockBuilder('Mars\RoverBundle\models\Rover')
            ->setMethods(["move"])
            ->setConstructorArgs([$coordinates, $instructions, $upperRightCoordinates ])
            ->getMock();

        $mock->expects($this->any())->method('move')->will($this->returnValue($returnValue));

        $this->assertEquals($expected , $mock->changeDirection());
    }

    public function provider()
    {
        return array(
            ['1 2 N', 'M',   [5, 5], [1, 3], ['N', [1, 3] ] ],
            ['2 3 S', 'RRM', [5, 5], [2, 4], ['N', [2, 4] ] ],
            ['2 3 S', 'RM',  [5, 5], [1, 3], ['W', [1, 3] ] ],
        );
    }

}