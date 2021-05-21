<?php
class CharacterFactory {
    //Generates game character on the basis of character name passed
    public function returnCharacter($characterName) {
        if(empty($characterName)) {
            return null;
        } else if ($characterName == DynamoConstants::NAME) {
            $d = new Dynamo();
            $d->__set('name',DynamoConstants::NAME);
            $d->__set('health',Utils::generateRandomValue(DynamoConstants::MIN_HEALTH,DynamoConstants::MAX_HEALTH));
            $d->__set('strength',Utils::generateRandomValue(DynamoConstants::MIN_STRENGTH,DynamoConstants::MAX_STRENGTH));
            $d->__set('defence',Utils::generateRandomValue(DynamoConstants::MIN_DEFENCE,DynamoConstants::MAX_DEFENCE));
            $d->__set('speed',Utils::generateRandomValue(DynamoConstants::MIN_SPEED,DynamoConstants::MAX_SPEED));
            $d->__set('luck',Utils::generateRandomValue(DynamoConstants::MIN_LUCK_PER,DynamoConstants::MAX_LUCK_PER));
            return $d;
        }else if($characterName == WildBeastConstants::NAME) {
            $w = new WildBeast();
            $w->__set('name',WildBeastConstants::NAME);
            $w->__set('health',Utils::generateRandomValue(WildBeastConstants::MIN_HEALTH,WildBeastConstants::MAX_HEALTH));
            $w->__set('strength',Utils::generateRandomValue(WildBeastConstants::MIN_STRENGTH,WildBeastConstants::MAX_STRENGTH));
            $w->__set('defence',Utils::generateRandomValue(WildBeastConstants::MIN_DEFENCE,WildBeastConstants::MAX_DEFENCE));
            $w->__set('speed',Utils::generateRandomValue(WildBeastConstants::MIN_SPEED,WildBeastConstants::MAX_SPEED));
            $w->__set('luck',Utils::generateRandomValue(WildBeastConstants::MIN_LUCK_PER,WildBeastConstants::MAX_LUCK_PER));
            return $w;
        } else {
            return null;
        }
    }
}
?>