<?php

/*
 * EXAMPLE HELPER CLASS
 */
class ValidationHelper {

    public static function validateInput($value)
    {
        $value = trim($value);
        $value = stripcslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }

}

?>