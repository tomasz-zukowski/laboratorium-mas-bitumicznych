<?php

abstract class view
{

    /** tytuł */
    public $title;
    public static $vars;
    public static $rendered_file;

    /**
     * Zmiana tytułu strony
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Ustawienie wartości przekazywanej do widoku
     * @param $variable
     * @param $value
     * @param bool $array = false
     * @return bool
     * @throws Exception
     */
    public static function set($variable, $value, $array=false)
    {
        try
        {
            if(is_bool($array))
            {
                if($array==true)
                {
                    self::$vars[$variable][] = $value;
                }
                else
                {
                    self::$vars[$variable] = $value;
                }
            }
            else
            {
                throw new Exception('Undexpected $array parameter type!');
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
            exit;
        }
    }

    /**
     * Pobieranie wartości
     * @param $arg1
     * @param null $arg2
     * @param null $arg3
     * @return mixed
     */
    public function get($arg1, $arg2 = null, $arg3 = null)
    {
        if(isset($arg3))
        {
            if(isset(self::$vars[$arg1][$arg2][$arg3]))
            {
                return self::$vars[$arg1][$arg2][$arg3];
            }
            else
            {
                return false;
            }
        }
        else if(isset($arg2))
        {
            if(isset(self::$vars[$arg1][$arg2]))
            {
                return self::$vars[$arg1][$arg2];
            }
            else
            {
                return false;
            }
        }
        else if(isset($arg1))
        {
            if(isset(self::$vars[$arg1]))
            {
                return self::$vars[$arg1];
            }
            else
            {
                return null;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Załaduj model
     * @param null $name
     * @return mixed
     */
    public function loadModel($name = null)
    {
        (empty($name)) ? $model_name = Router::getModel() : $model_name = $name;
        $path       = 'Models/' . $model_name . '.php';
        try
        {
            if(is_file($path))
            {
                include_once $path;
                $Model = new $model_name();
            }
            else
            {
                throw new Exception('Cant open Model file');
            }
        } catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
            exit;
        }

        return $Model;
    }

    /**
     * Wygenerowanie pliku z widokiem
     * @param $filename
     * @return string|bool $renderedView
     */
    public function render($filename)
    {
        $path = 'Templates/'.$_SESSION['layout'].'/' . Router::$controller . '/' . $filename . '.php';

        if(!empty($filename) && file_exists($path))
        {
            self::$rendered_file = $filename;

            $_path      = PATH;
            $_this_path = $_path . '/' . Router::$controller . '/' . Router::$action . '/' . Router::$params_line;
            include $path;
        }
        else
        {
            return false;
        }
    }

    /**
     * Tworzenie okna z powiadomieniem i przekierowaniem
     * po czasie i do określonej lokalizacji
     * @param null $description
     * @param string $class values {success|warning|info|danger}
     * @param null $alert_destination
     * @param int $alert_time
     */
    public static function setAlertPanel($description=null, $class='success', $alert_destination = null, $alert_time=3)
    {
        $description = '<b>'.$description.'</b>';
        self::set('_alert_panel',array('class'=>$class,'description'=>$description,'alert_time'=>$alert_time,'alert_destination'=>$alert_destination));
    }

    /**
     * Czy ustawiony jest alert
     * @return bool
     */
    public static function isSetAlertPanel()
    {
        if(isset(self::$vars['_alert_panel']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Tworzenie okna prompt
     * @param null $id - id okna
     * @param null $content - tresc okna
     * @param bool $ok_button - czy przycisk ok
     * @param string $ok_button_class - klasa przycisku ok values {success|warning|info|danger}
     * @param bool $cancel_button - czy przycisk cence
     * @param string $cencel_button_class - klasa przycisku cencel values {success|warning|info|danger}
     * @param bool $closeable - czy możliwość zamknięcia okna
     * @param null $title - tytul okna
     * @param string $size rozmiar okna values {'',modal_lg, modal_sm}
     * @return bool
     */
    public static function setPromptWindow($id=null, $title=null, $content=null, $size='', $ok_button=true, $cancel_button=true, $closeable=true, $ok_button_class='default', $cencel_button_class='default', $method=null, $action=null)
    {
        try
        {
            if(isset(self::$vars['_prompts']))
            {
                foreach(self::$vars['_prompts'] as $prompt)
                {
                    if($prompt['id']==$id)
                    {
                        throw new Exception('Duplicated prompt ID!');
                    }
                }
            }
            self::set('_prompts',array('id'=>$id,'size'=>$size,'content'=>$content,'ok_button'=>$ok_button,'ok_button_class'=>$ok_button_class,'cencel_button_class'=>$cencel_button_class,'cancel_button'=>$cancel_button,'closeable'=>$closeable,'title'=>$title,'method'=>$method,'action'=>$action),true);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
            exit;
        }
    }

    /**
     * Sprawdzenie czy utworzone jest okno prompt o podanym id
     * @param null $id - id okna
     * @return mixed
     */
    public static function isSetPromptWindow($id=null)
    {
        if($id!=null)
        {
            if(isset(self::$vars['_prompts']))
            {
                foreach(self::$vars['_prompts'] as $prompt)
                {
                    if($prompt['id']==$id)
                    {
                        return $prompt['id'];
                    }
                }
                return false;
            }
            else
            {
                return false;
            }
        }
        else
        {
            if(isset(self::$vars['_prompts']))
            {
                return self::$vars['_prompts'];
            }
            else
            {
                return false;
            }
        }
    }
}