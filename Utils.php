<?php 
class Utils {
    /**Generates random values between a range*/
    public static function generateRandomValue($min,$max) {
        return rand($min,$max);
    }
}
?>