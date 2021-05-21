<?php
include "autoloader.php";
class Dynamo extends Character{
  //Strike Constants
  const IS_RAPID_STRIKE = 2;
  const IS_MAGIC_SHIELD = 2;

  //@Override
  public function getAttack() {
    $probability = Utils::generateRandomValue(1,100);
    if($probability<=DynamoConstants::RAPID_STRIKE) {
      return self::IS_RAPID_STRIKE;
    } else {
      return self::IS_NORMAL_STRIKE;
    }
  }

  //@Override
  public function getDefence() {
    $probabilityOfLuck = Utils::generateRandomValue(1,100);
    $probabilityOfMagicShield = Utils::generateRandomValue(1,100);
    if($probabilityOfLuck<=$this->luck) {
      return self::IS_LUCKY_DEFENCE;
    } else if ($probabilityOfMagicShield<=DynamoConstants::MAGIC_SHIELD) {
      return self::IS_MAGIC_SHIELD;
    } else {
      return self::IS_NORMAL_DEFENCE;
    }
  }
}
?>