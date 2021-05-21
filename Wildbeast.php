<?php
include "autoloader.php";
class WildBeast extends Character {

  //@Override
  public function getAttack() {
      return self::IS_NORMAL_STRIKE;
  }

  //@Override
  public function getDefence() {
    $probabilityOfLuck = Utils::generateRandomValue(1,100);
    if($probabilityOfLuck<=$this->luck) {
      return self::IS_LUCKY_DEFENCE;
    } else {
      return self::IS_NORMAL_DEFENCE;
    }
  }
} 
?>