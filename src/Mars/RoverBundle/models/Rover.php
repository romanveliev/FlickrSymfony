<?php
namespace Mars\RoverBundle\models;

use Mars\RoverBundle\Exceptions\MarsException;
/**
 * Class MainRover
 * @package Mars\RoverBundle\models\MainRover
 */
class Rover extends MainRover{
    use LookLeftTrait,LookRightTrait;
    /**@var int $x             */
    private $x;
    /**@var int $y             */
    private $y;
    /**@var string $direction  */
    private $direction;
    /**@var array $array       */
    private $array = ['N', 'E', 'S', 'W'];
    /**@var int $maxX          */
    private $maxX;
    /**@var int $maxY          */
    private $maxY;
    /**@var array $output      */
    private $output=[];

    /**
     * @param $coordinate
     * @param $direction
     * @param $upperRight
     */
    public function __construct($coordinate, $direction, $upperRight){
        $this->maxX = $upperRight[0];
        $this->maxY = $upperRight[1];
        $arr = explode(' ', $coordinate);
        $this->x = $arr[0];
        $this->y = $arr[1];
        $this->direction = $arr[2];
        $_SESSION['direction'] = $arr[2];
        $arr = str_split($direction);
        foreach($arr as $dir){
            $this->output = $this->changeDirection($dir);
        }
        return $this;
    }
    /**
     * @param $direction
     * @return array
     */
    protected function changeDirection($direction)
    {
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
                $this->move($direction);
            } catch (MarsException $e) {
                echo $e->getMessage();die();
            }
        }
        return [$this->direction, [$this->x, $this->y]];
    }
    /**
     * @param $direction
     * @return array
     * @throws MarsException
     */
    protected function move($direction){
        if ($this->direction == 'N' ) {
            if($this->y + 1 > $this->maxY ){
                throw new MarsException("End of plateau: ".$direction.' Last coordinate: '.$this->x.' '.$this->y);
            }else{
                $this->y+=1;
            }
        }
        if ($this->direction == 'S') {
            if($this->y - 1 <0){
                throw new MarsException("End of plateau: ".$direction.' Last coordinate: '.$this->x.' '.$this->y);
            }else{
                $this->y -= 1;
            }
        }
        if ($this->direction == 'E') {
            if($this->x + 1 >$this->maxX){
                throw new MarsException("End of plateau: ".$direction.' Last coordinate: '.$this->x.' '.$this->y);
            }else{
                $this->x += 1;
            }
        }
        if ($this->direction == 'W') {
            if($this->x - 1 <0){
                throw new MarsException("End of plateau: ".$direction.' Last coordinate: '.$this->x.' '.$this->y);
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