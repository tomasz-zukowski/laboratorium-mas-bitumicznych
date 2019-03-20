<?php

class modules_model extends model {

    public function getModulesList($all = true) {

        /** pozyskanie listy modułów */
        $modules = Permissions::getModules();
        $counter = 0;

        $modules_list = array();

        foreach($modules as $mod)
        {
            if($all==true)
            {
                $query = "SELECT description, version, required, _active FROM _conf_module_list WHERE module_name = '$mod'";
            }
            else
            {
                $query = "SELECT description, version, required FROM _conf_module_list WHERE module_name = '$mod' AND _active = 1";
            }
            if($temp = $this->getData($query))
            {
                $modules_list[$counter]         = $temp;
                $modules_list[$counter]['name'] = $mod;
                $counter++;
            }
        }

        return $modules_list;
    }

    /**
     * Pobieranie jednego modułu
     * @param $name
     * @return array
     */
    public function getModule($name) {

        /** pozyskanie listy modułów */
        $modules = Permissions::getModules();

        $module = array();

        foreach($modules as $mod)
        {
            if($mod==$name)
            {
                $query = "SELECT description, version, required, _active FROM _conf_module_list WHERE module_name = '$mod'";
            }
            if($temp = $this->getData($query))
            {
                $module[0] = $temp;
            }
        }

        return $module;
    }

    public function switchModuleStatus($module) {

        if(Permissions::checkModule($module))
        {
            $temp_module = $this->getModule($module);

            if($temp_module[0]['_active']==1)
            {
                if($this->runQuery("UPDATE _conf_module_list SET _active = 0 WHERE module_name = '$module'")
                && $this->runQuery("UPDATE _conf_navigation_links SET _active =0 WHERE location LIKE '%$module/%'"))
                {
                    view::setAlertPanel('Moduł został wyłączony poprawnie','success','/modules/manage/',3);
                }
                else
                {
                    view::setAlertPanel('Nie udało się wyłączyć modułu!','danger');
                }
            }
            else
            {
                if($this->runQuery("UPDATE _conf_module_list SET _active = 1 WHERE module_name = '$module'")
                    && $this->runQuery("UPDATE _conf_navigation_links SET _active = 1 WHERE location LIKE '%$module/%'"))
                {
                    view::setAlertPanel('Moduł został włączony poprawnie','success','/modules/manage/',3);
                }
                else
                {
                    view::setAlertPanel('Nie udało się włączyć modułu!','danger');
                }
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Instalowanie paczki ZIP z modułem
     * @param $file_path - sciezka do paczki - tymczasowa
     * @param $file_name - nazwa pliku
     * @param $key - klucz do pliku - hasło
     */
    public function installModuleFromZIP($file_path, $file_name, $key) {

        $unziper = new ZipArchive();

        if($unziper->open($file_path) === true)
        {
            $module_name = substr($file_name,0,strpos($file_name,'.'));
            $new_path = 'Others/TEMP/'.$module_name;

            try
            {
                echo "Rozpakowywanie pakietu.. ";

                $unziper->setPassword($key);
                $unziper->extractTo($new_path);
                if(is_dir($new_path))
                {
                    echo "<span class='fa fa-check text-success'></span><br /><br />";
                }
                else
                {
                    echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                    $_errors[] = 'Wystąpił błąd podczas rozpakowywania pakietu<br />';
                }

                flush();
                ob_flush();

                echo "Analizowanie pakietu.. ";
                if(Permissions::checkModule($module_name,$new_path))
                {
                    echo "<span class='fa fa-check text-success'></span><br /><br />";
                }
                else
                {
                    echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                    $_errors[] = 'Pakiet zawiera niepoprawną strukturę plików.<br />';
                }

                flush();
                ob_flush();

                $this->runQuery("START TRANSACTION");

                $DB_model = $this->loadModel('database_model');
                echo "Obsługa bazy danych.. ";
                if(is_file($new_path.'/Others/Modules_DB/'.$module_name.'.sql') && is_file($new_path.'/Others/Modules_DB/'.$module_name.'_delete.sql'))
                {
                    if($DB_model->inputTablesFromFile($new_path.'/Others/Modules_DB/'.$module_name.'.sql'))
                    {
                        echo "<span class='fa fa-check text-success'></span><br /><br />";
                    }
                    else
                    {
                        echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                        $_errors[] = 'Wystąpił błąd podczas tworzenia struktury tabel bazy danych<br />';
                    }
                }
                else
                {
                    echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                    $_errors[] = 'Nie znaleziono plików sql<br />';
                }

                flush();
                ob_flush();

                if(empty($_errors))
                {
                    if($unziper->extractTo($_SERVER['DOCUMENT_ROOT']))
                    {
                        others::deleteDir($new_path);
                        echo "<div class='alert alert-success'>Instalacja zakończona sukcesem! <a href='/modules/manage' style='font-weight: bold;'>Przejdź dalej</a></div>";
                        $this->runQuery("COMMIT");
                    }
                    else
                    {
                        $DB_model->inputTablesFromFile($new_path.'/Others/Modules_DB/'.$module_name.'_delete.sql');
                        others::deleteDir($new_path);
                        echo "<div class='alert alert-danger'>Wystąpił błąd podczas instalacji. Pliki tymczasowe zostały wyczyszczone. <a href='/modules/manage' style='font-weight: bold;'>Powrót</a></div>";
                        $this->runQuery("ROLLBACK");
                    }
                }
                else
                {
                    $DB_model->inputTablesFromFile($new_path.'/Others/Modules_DB/'.$module_name.'_delete.sql');
                    others::deleteDir($new_path);
                    echo "<div class='alert alert-danger'>Wystąpił błąd podczas instalacji. Pliki tymczasowe zostały wyczyszczone. <a href='/modules/manage' style='font-weight: bold;'>Powrót</a></div>";
                    $this->runQuery("ROLLBACK");
                }

            } catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
        else
        {
            view::setAlertPanel('Nie udało się otworzyć pakietu! <a href="/modules/manage" style="font-weight: bold;">Powrót</a>', 'danger');
        }
    }

    public function installApp($post) {

        if($this->checkStartSQLFile())
        {
            $this->runQuery("START TRANSACTION");

            include 'Conf/database_mysql.php';

            echo "Sprawdzanie klucza.. ";
            if($post['key']==$settings['key'])
            {
                echo "<span class='fa fa-check text-success'></span><br /><br />";
            }
            else
            {
                echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                $_errors[] = 'Klucz nie jest prawidłowy<br />';
            }

            $DB_model = $this->loadModel('database_model');

            echo "Tworzenie bazy danych.. ";
            if($this->runQuery("CREATE DATABASE IF NOT EXISTS ".$settings['dbase']." DEFAULT CHARACTER SET = 'utf8' DEFAULT COLLATE 'utf8_polish_ci'"))
            {
                echo "<span class='fa fa-check text-success'></span><br /><br />";
            }
            else
            {
                echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                $_errors[] = 'Wystąpił błąd podczas tworzenia bazy danych<br />';
            }

            flush();
            ob_flush();

            echo "Instalacja bazy danych.. ";
            if(is_file('Others/Backups/_start.sql') && is_file('Others/Backups/_delete.sql'))
            {
                if($DB_model->inputTablesFromFile('Others/Backups/_start.sql'))
                {
                    echo "<span class='fa fa-check text-success'></span><br /><br />";
                }
                else
                {
                    echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                    $_errors[] = 'Wystąpił błąd podczas tworzenia struktury tabel bazy danych<br />';
                }
            }
            else
            {
                echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                $_errors[] = 'Nie znaleziono plików sql<br />';
            }

            flush();
            ob_flush();

            echo "Tworzenie konta administratora.. ";
            $USERS_model = $this->loadModel('users_model');
            if($USERS_model->newUser($post))
            {
                echo "<span class='fa fa-check text-success'></span><br /><br />";
            }
            else
            {
                echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                $_errors[] = 'Wystąpił błąd podczas tworzenia użytkownika<br />';
            }

            flush();
            ob_flush();

            if(empty($_errors))
            {
                echo "<div class='alert alert-success'>Instalacja zakończona sukcesem! <a href='/users/log_in' style='font-weight: bold;'>Przejdź dalej</a></div>";
                $this->runQuery("COMMIT");
            }
            else
            {
                $DB_model->inputTablesFromFile('Others/Backups/_delete.sql');
                echo "<div class='alert alert-danger'>Wystąpił błąd podczas instalacji. <a href='/modules/install_app' style='font-weight: bold;'>Powrót</a></div>";
                $this->runQuery("ROLLBACK");
            }

            flush();
            ob_flush();
        }
        else
        {
            echo "Proces instalacji został zatrzymany <span class='fa fa-ban text-danger'></span>";

            flush();
            ob_flush();
        }
    }

    /**
     * Sprawdzanie czy plik start.sql znajduje sie w odpowiednim miejscu
     * @return bool
     */
    public function checkStartSQLFile() {

        if(is_file('Others/Backups/_start.sql')
            && is_file('Others/Backups/_delete.sql'))
        {
            return true;
        }
        else
        {
            view::setAlertPanel('Brak pliku startowego ze strukturą bazy danych!','danger',null,null);
            return false;
        }

    }
}