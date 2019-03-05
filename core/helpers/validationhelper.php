<?php

/*
 * EXAMPLE HELPER CLASS
 */
class ValidationHelper {

    public static function validateInput($value)
    {
        $value = htmlspecialchars(stripcslashes(trim($value)));
        return $value;
    }

}

?>