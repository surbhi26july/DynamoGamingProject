<?php
include "Utils.php";
abstract class Character {
    //Defence Constants
    const IS_LUCKY_DEFENCE = 0;
    const IS_NORMAL_DEFENCE = 1;
    
    //Strike Constant
    const IS_NORMAL_STRIKE = 0;

    private $name;
    private $health;
    private $strength;
    private $defence;
    private $speed;
    private $luck;

    //Getter
    public function __get($property) {
        return ($this->$property);
    }

    //Setter
    public function __set($property,$val) {
        $this->$property = $val;
    }

    //Prints property values
    public function __toString() {
        print_r("<b>".$this->__get('name')."</b><br>H : ".$this->health." , ST : ".$this->strength." , D : ".$this->defence." , SP : ".$this->speed." , L : ".$this->luck."<br>");
    }

    abstract public function getDefence();
    abstract public function getAttack();
}
?>