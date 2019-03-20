<?php

class Permissions {

    public static $rights_set;
    public static $modules_list;

    /**
     * pobranie listy uprawnien użytkownika i zapisanie do tablicy rights_set
     * w przypadku braku uprawnień przypisuje uprawnienie gościa (tak aby tabela nie była pusta)
     * @param $array_rights
     * @return bool
     */
    public static function setRights($array_rights) {

        if(isset($_SESSION['id']))
        {
            if(is_array($array_rights) && !empty($array_rights))
            {
                foreach($array_rights as $right)
                {
                    self::$rights_set[] = $right['right_name'];
                }
                $_SESSION['rights_set'] = self::$rights_set;
                return true;
            }
            else
            {
                $_SESSION['rights_set'] = array('guest'=>'guest');
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Pobranie listy zainstalowanych modułów
     * na podstawie plików kontrolerów
     */
    public static function setModules() {

        /** wyzerowanie listy **/
        self::$modules_list = null;

        $directories = scandir("Controllers");
        foreach($directories as $dir)
        {
            if(!strpos($dir,"_controller.php"))
            {
                continue;
            }
            else
            {
                $mod_name = explode("_",$dir);
                self::$modules_list[] = $mod_name[0];
            }
        }
    }

    /**
     * Zwracanie listy modułów w postaci tablicy
     * @return bool
     */
    public static function getModules() {

        self::setModules();

        if(is_array(self::$modules_list) && !empty(self::$modules_list))
        {
            return self::$modules_list;
        }

        return false;

    }

    /**
     * Sprawdzenie poprawności modułu. Czy występuje kontroler, widok, model oraz czy folder z szablonami zawiera pliki widoków.
     * @param $module
     * @return bool
     */
    public static function checkModule($module, $path = null) {

        if($path == null)
        {
            if(is_file('Controllers/'.$module.'_controller.php')
                && is_file('Models/'.$module.'_model.php')
                && is_file('Views/'.$module.'_view.php')
                && is_dir('Templates/'.$_SESSION['layout'].'/'.$module))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else //do instalacji modułów
        {
            if(is_file($path.'/Controllers/'.$module.'_controller.php')
                && is_file($path.'/Models/'.$module.'_model.php')
                && is_file($path.'/Views/'.$module.'_view.php')
                && is_file($path.'/Others/Modules_DB/'.$module.'.sql')
                && is_file($path.'/Others/Modules_DB/'.$module.'_delete.sql')
                && is_dir($path.'/Templates/'.$_SESSION['layout'].'/'.$module))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }

    /**
     * @param $module
     * @return bool
     */
    public static function deleteModule($module) {

        if(unlink('Controllers/'.$module.'_controller.php')
            && unlink('Models/'.$module.'_model.php')
            && unlink('Views/'.$module.'_view.php')
            && unlink('Others/Modules_DB/'.$module.'.sql')
            && unlink('Others/Modules_DB/'.$module.'_delete.sql')
            && unlink('Others/Modules_RIGHTS/'.$module.'.php')
            && others::deleteDir('Templates/'.$_SESSION['layout'].'/'.$module))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Sprawdzanie czy utworzona jest sesja użytkownika
     * musi sprawdzać czy użytkownik ma dostęp do danego widoku
     * jeżeli nie to przekierowania
     * @param $right
     * @param bool $forwarding
     * @return bool
     */
    public static function checkPermission($right, $forwarding=false) {

        if(!empty($_SESSION['id']))
        {
            if(is_string($right))
            {
                $right = trim($right);
            }

            /** Bool - jezeli Permissions::checkPermission(true); - przepuszcza */
            if($right===true)
            {
                return true;
            }

            /** String - sprawdza czy uprawnienie znajduje się w tabeli */
            if(is_string($right) && !empty($right))
            {
                if(in_array($right,$_SESSION['rights_set']))
                {
                    return true;
                }
            }

            if($forwarding==true)
            {
                Permissions::forwarding('/errors/access_denied');
            }

            //brak uprawnień
            return false;
        }
        else
        {
            if($right!==false)
            {
                $_SESSION['request_url'] = '/'. Router::$controller .'/'. Router::$action .'/'. Router::$params_line;
                if($forwarding==true)
                {
                    Permissions::forwarding(startupDIR_unlogg);
                }
            }

            return false;
        }

    }

    /**
     * przekierowanie na sciezke - natychmiastowe
     * @param string $path
     */
    public static function forwarding($path = '') {

        header('Location: '.$path);
        exit;

    }

}