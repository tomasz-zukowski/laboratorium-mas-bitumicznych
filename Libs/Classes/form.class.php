<?php

class form extends validation {

    private $errors = array();

    /**
     * Generowanie błędu
     * @param $field
     * @param $msg
     * @param string $class
     * @param bool $append
     * @return bool
     */
    public function setError($field, $msg, $class='has-error', $append=true) {

        if(!is_null($field) && !is_null($msg) && !is_null($class))
        {
            try
            {
                if($append==false)
                {
                    if(!isset($this->errors[$field]))
                    {
                        $this->errors[$field]['class']     = $class;
                        $this->errors[$field]['error_msg'] = $msg;
                    }
                    else
                    {
                        throw new Exception('Wystąpił błąd');
                    }
                }
                else
                {
                    if(!isset($this->errors[$field]))
                    {
                        $this->errors[$field]['class']     = $class;
                        $this->errors[$field]['error_msg'] = $msg;
                    }
                    else
                    {
                        $this->errors[$field]['class']     = $class;
                        $this->errors[$field]['error_msg'] .= $msg;
                    }
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                return false;
                exit;
            }
        }

    }

    /**
     * Sprawdzenie czy formularz wygenerował błędy
     * @return bool
     */
    public function noErrors() {

        if(is_array($this->errors) && !empty($this->errors))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Pobranie komunikatu o błędzie
     * @param bool $field
     * @return array|bool
     */
    public function getErrors($field=false) {

        if(is_array($this->errors) && !empty($this->errors))
        {
            if(is_bool($field) && $field!=false)
            {
                if(isset($this->errors[$field]))
                {
                    return $this->errors[$field];
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return $this->errors;
            }
        }
        else
        {
            return false;
        }
    }

} 