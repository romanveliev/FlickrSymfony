<?php
namespace Mars\RoverBundle\models;

use Mars\RoverBundle\Exceptions\MarsException;
/**
 * Class MainRover
 * @package Mars\RoverBundle\models\MainRover
 */
class Rover extends MainRover{
    use LookLeftTrait,LookRightTrait;

    /**@var array $array       */
    private $array = ['N', 'E', 'S', 'W'];
    /**@var int $x             */
    private $x;
    /**@var int $y             */
    private $y;
    /**@var string $direction  */
    private $direction;

    /**@var int $maxX          */
    private $maxX;
    /**@var int $maxY          */
    private $maxY;
    /**@var array $output      */
    private $output=[];
    /** @var array */
    private $arr;

    /** @var string $coordinate*/
    private $coordinate;
    private $instructions;
    /** @var array $upperRight */
    private $upperRight;


    /**
     * @param $coordinate
     * @param $direction
     * @param $upperRight
     */
    public function __construct($coordinate, $direction, $upperRight){
        $this->upperRight = $upperRight;
        $this->coordinate = $coordinate;
        $this->instructions = $direction;
        $this->init();

    }

    private function init(){
        if((int)$this->upperRight[0] && (int)$this->upperRight[0] != 0 ) {
            $this->maxX = $this->upperRight[0];
            $this->maxY = $this->upperRight[1];

            $arr = explode(' ', $this->coordinate);
            $this->x = $arr[0];
            $this->y = $arr[1];
            $this->direction = $arr[2];

            $this->instructions = str_split($this->instructions);
        }

    }

    /**
     * @return array
     */
    public function changeDirection()
    {
        foreach($this->instructions as $dir){
            $direction = $dir;
            $length = count($this->array);
            $key = array_search($this->direction, $this->array);
            if ( $direction == 'R' )
            {
                $this->direction = $this->lookRight($key,$length);
            }
            if ($direction == 'L')
            {
                $this->direction = $this->lookLeft($key,$length);
            }
            if($direction == 'M'){
                try {
                    $coordinates = $this->move();
                } catch (MarsException $e) {
                    echo $e->getMessage();die();
                }
                return [$this->direction, [$coordinates[0], $coordinates[1] ] ];
            }
            $this->output =  [$this->direction, [$this->x, $this->y]];
        }
        return $this->output;
    }
    /**
     * @return array
     * @throws MarsException
     */
    public function move(){
        if ($this->direction == 'N' ) {
            if($this->y + 1 > $this->maxY ){
                throw new MarsException('End of plateau. Last coordinate: '.$this->x.' '.$this->y);
            }else{
                $this->y+=1;
            }
        }
        if ($this->direction == 'S') {
            if($this->y - 1 <0){
                throw new MarsException('End of plateau. Last coordinate: '.$this->x.' '.$this->y);
            }else{
                $this->y -= 1;
            }
        }
        if ($this->direction == 'E') {
            if($this->x + 1 >$this->maxX){
                throw new MarsException('End of plateau. Last coordinate: '.$this->x.' '.$this->y);
            }else{
                $this->x += 1;
            }
        }
        if ($this->direction == 'W') {
            if($this->x - 1 <0){
                throw new MarsException('End of plateau. Last coordinate: '.$this->x.' '.$this->y);
            }else{
                $this->x -= 1;
            }
        }
        return [$this->x, $this->y];
    }
    /**
     * @return int
     */
    public function getX(){
        return $this->x;
    }
    /**
     * @return int
     */
    public function getY(){
        return $this->y;
    }
    /**
     * @return string
     */
    public function getDirection(){
        return $this->direction;
    }
}