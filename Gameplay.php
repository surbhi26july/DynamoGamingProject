<?php
include "autoloader.php";
class GamePlay implements GamePlayInterface {
    const MAX_TURNS = 20;

    private $dynamo;
    private $wildBeast;
    private $turn;
    private $attacker;
    private $defender;

    public function __construct() {
        $this->turn = 0;
    }

    //@Override
    public function startGame() {
        $this->initCharacters();
        $this->printCharacterValues();
    }

    //@Override
    public function fightCharacters() {
        $firstAttacker = $this->findFirstAttackBy();
        if($firstAttacker instanceof Dynamo) {
            $this->fight($this->dynamo,$this->wildBeast);
        } else {
            $this->fight($this->wildBeast,$this->dynamo);
        }
    }

    //@Override
    public function endGame() {
        if($this->dynamo->__get('health') > $this->wildBeast->__get('health')) {
            echo "<br> Winner is : <b><i>".$this->dynamo->__get('name')."</i></b>"; 
        } else if($this->dynamo->__get('health') < $this->wildBeast->__get('health')) {
            echo "<br> Winner is : <b><i>".$this->wildBeast->__get('name')."</i></b>";
        } else {
            echo "<br> It's a Tie";
        }
        echo "<br>"."The game has now ended.";
    }

    //Method called to fight characters
    private function fight($attacker,$defender) {
        if($this->turn<=self::MAX_TURNS && $attacker->__get('health')>0 && $defender->__get('health')) {
            $logStr = "";
            $this->turn++;

            //Assigns attacker and defender
            $this->attacker = $attacker;
            $this->defender = $defender;

            //Gets attack and defend mode
            $attack = $this->attacker->getAttack();
            $defence = $this->defender->getDefence();

            //Calculates damage and assigns new health to defender
            $damage = 0;
            if (!$this->isDefenderLucky($defence)) {
                $damage = $attacker->__get('strength') - $defender->__get('defence');
                if ($this->isDefenderDynamoAndUsesMagicShield($defence)) {
                    $logStr = $logStr.$this->defender->__get('name')." used <b>MAGIC SHIELD</b> , ";
                    $damage = $damage/2;
                } else {
                    $logStr = $logStr.$this->defender->__get('name')." used <b>NORMAL DEFENCE</b> , ";
                }
            } else {
                $logStr = $logStr.$this->defender->__get('name'). " was <b>LUCKY</b> this time , ";
            }
            $this->setDamageToDefender($damage);
            
            //Checks if rapid strike and repeats the method
            if ($this->isAttackerDynamoAndUsesRapidStrike($attack)) {  
                $logStr = $logStr.$this->attacker->__get('name')." used <b>RAPID STRIKE</b>";   
                $logStr = $logStr."<br>Damage : ".$damage." , New Health : ".$this->defender->__get('health');
                $this->printLog($logStr);
                return $this->fight($attacker, $defender);
            } else {
                $logStr = $logStr.$this->attacker->__get('name'). " used <b>NORMAL STRIKE</b>";
            }
            $logStr = $logStr."<br>Damage Done : ".$damage." , New Health : ".$this->defender->__get('health');
            $this->printLog($logStr);
            return $this->fight($defender, $attacker);
        } else {
            $this->endGame();
            return;
        }
    }

    //Method called to print logs every turn
    private function printLog($logStr) {
        print_r("<br><b> Turn : </b>".$this->turn."<br>");
        print_r("Attacker : ".$this->attacker->__get('name')." , Defender : ".$this->defender->__get('name')."<br>");
        print_r($logStr."<br>");
        print_r("Updated Values :<br>");
        $this->printCharacterValues();
    }

    //Checks if defender is lucky
    private function isDefenderLucky($defence) {
        return $defence == Character::IS_LUCKY_DEFENCE;
    }

    //Checks if attacker is dynamo and uses rapid stike
    private function isAttackerDynamoAndUsesRapidStrike($attack) {
        return $this->attacker instanceof Dynamo && $attack == Dynamo::IS_RAPID_STRIKE;
    }

    //Checks if defender is dynamo and he uses magic shield
    private function isDefenderDynamoAndUsesMagicShield($defence) {
        return $this->defender instanceof Dynamo && $defence == Dynamo::IS_MAGIC_SHIELD;
    }

    //Subtracts damage from defender health
    private function setDamageToDefender($damageToDefender) {
        $this->defender->__set('health',($this->defender->__get('health') - $damageToDefender));
    }

    //Finds who will start the game
    private function findFirstAttackBy() {
        if($this->dynamo->__get('speed')>$this->wildBeast->__get('speed')) {
            return $this->dynamo;
        } else if ($this->dynamo->__get('speed')<$this->wildBeast->__get('speed')) {
            return $this->wildBeast ;
        } else {
            if($this->dynamo->__get('luck')>=$this->wildBeast->__get('luck')) {
                return $this->dynamo;
            } else {
                return $this->wildBeast;
            }
        }
    }

    //Initializes characters
    private function initCharacters() {
        $factory = new CharacterFactory();
        $this->dynamo = $factory->returnCharacter(DynamoConstants::NAME);
        $this->wildBeast = $factory->returnCharacter(WildBeastConstants::NAME); 
    }

    //Prints character properties
    private function printCharacterValues() {
       $this->dynamo->__toString();
       $this->wildBeast->__toString();
    }
}
?>