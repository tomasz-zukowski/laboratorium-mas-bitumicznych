<?php

class validation {

    /**
     * Sprawdzanie wyrażenia regularnego
     * @param null $string
     * @param null $pattern
     * @return bool
     */
    public static function checkExpression($string = null, $pattern = null) {

        if(!is_null($string) && !is_null($pattern))
        {
            if(preg_match($pattern,$string))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }

    }

    /**
     * Predefiniowana metoda sprawdzajaca maila
     * @param null $email
     * @param string $pattern
     * @return bool
     */
    public static function checkEmail($email = null, $pattern = '/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D') {

        return self::checkExpression($email, $pattern);
    }

    /**
     * Predefiniowana metoda sprawdzajaca czy ciąg jest numerem telefonu
     * @param null $phone
     * @param string $pattern
     * @return bool
     */
    public static function checkPhone($phone = null, $pattern = '/^0-\d{3}-\d{3}-\d{3}$/') {

        return self::checkExpression($phone,$pattern);
    }

    /**
     * Predefiniowana metoda sprawdzajaca czy ciąg jest numeryczny
     * @param null $number
     * @param string $pattern
     * @return bool
     */
    public static function checkNumerical($number = null, $pattern = '/^\d+$/') {

        return self::checkExpression($number, $pattern);
    }

    /**
     * Predefiniowana metoda sprawdzajaca czy ciąg jest alfabetyczny
     * @param null $string
     * @param string $pattern
     * @return bool
     */
    public static function checkAlphabetical($string = null, $pattern = '/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.,]+$/') {

        return self::checkExpression($string,$pattern);
    }

    /**
     * Predefiniowana metoda sprawdzajaca czy długość ciągu mieści się w podanych wartościach
     * @param null $string
     * @param null $minLength
     * @param null $maxLength
     * @return bool
     */
    public static function checkLength($string = null, $minLength = null, $maxLength = null) {

        if(!is_null($string))
        {
            if(!is_null($minLength) && is_null($maxLength))
            {
                return (strlen($string)>=$minLength) ? true : false;
            }
            elseif(!is_null($minLength) && !is_null($maxLength))
            {
                return (strlen($string)>=$minLength && strlen($string)<=$maxLength) ? true : false;
            }
            elseif(is_null($minLength) && !is_null($maxLength))
            {
                return (strlen($string)<=$maxLength) ? true : false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Sprawdzenie czy sa równe
     * @param null $param1
     * @param null $param2
     * @param bool $check_type
     * @return bool
     */
    public function checkEqual($param1=null, $param2=null, $check_type=false) {

        if(!is_null($param1) && !is_null($param2))
        {
            if($check_type==true)
            {
                if($param1==$param2)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                if($param1===$param2)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }

    }

    /**
     * Przygotowanie pola do zapytania SQL
     * @param null $params
     * @return null|string
     */
    public static function prepareForQuery($params = null) {

        if(!is_null($params))
        {
            $params = trim($params);
            $params = htmlspecialchars($params);
            return $params;
        }
        else
        {
            return null;
        }
    }
}