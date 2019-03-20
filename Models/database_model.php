<?php

class database_model extends model {

    private $backupDirPath = 'Others/Backups';

    /**
     * @param null $year
     * @param null $month
     * @param string $extension
     * @return array|bool
     */
    public function getBackupList($year = null,$month = null,$extension = 'sql') {

        /** przetwarzanie danych potrzebnych do wyznaczania zakresu */
        if(!is_null($year) && checkdate(1,1,$year))
        {
            $_year = $year;
        }
        else
        {
            $_year = date("Y");
        }

        if(!is_null($month) && checkdate($month,1,$_year))
        {
            $_month = $month;
        }
        else
        {
            $_month = date("m");
        }

        if($files = scandir($this->backupDirPath))
        {
            $backups = array();
            foreach($files as $file)
            {
                if(strpos($file, $extension) && substr(date("Y-m-d H:i:s",filemtime($this->backupDirPath.'/'.$file)),0,7)==$_year.'-'.$_month && $file!='_start.'.$extension && $file!='_delete.'.$extension)
                {
                    $backups[] = array("name"=>$file,"last_modify"=>date("Y-m-d H:i:s",filemtime($this->backupDirPath.'/'.$file)));
                }
            }

            if(!empty($backups))
            {
                return $backups;
            }

            return false;
        }

        return false;

    }

    /**
     * Pobieranie listy tabel
     * @param array $skip
     * @return array|bool
     */
    public function getTablesList($skip = array()) {

        try
        {
            if($all_tables = $this->pdo->query("SHOW TABLES"))
            {
                $tables = array();

                while($table = $all_tables->fetch(PDO::FETCH_NUM))
                {
                    if(!in_array($table[0],$skip))
                    {
                        $tables[] = $table[0];
                    }
                }

                if(!empty($tables))
                {
                    return $tables;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    /**
     * Zapis danych do pliku z backupem
     * @param null $name
     * @param null $filename
     * @return bool
     */
    public function saveTablesToFile($name=null, $filename) {

        /** jeżeli bez parametru to wszystkie tabele */
        if(!isset($name))
        {
            $tables = $this->getTablesList();
        }
        /** jeżeli parametr do tablica */
        elseif(isset($name) && is_array($name))
        {
            $tables = $name;
        }
        /** jeżeli parametr to nazwa tabeli */
        elseif(isset($name) && is_string($name))
        {
            $tables = array(strtolower($name));
        }

        if(!empty($tables))
        {
            if(file_exists($this->backupDirPath . '/' . $filename . '.sql'))
            {
                unlink($this->backupDirPath . '/' . $filename . '.sql');
            }

            $file_handle = fopen($this->backupDirPath . '/' . $filename . '.sql', 'a+');

            foreach($tables as $table)
            {
                /**
                 * Czy podana nazwa tabeli w parametrze zgadza sie z nazwami tabel w bazie
                 */
                if(in_array($table, $this->getTablesList()))
                {
                    $structure   = $this->getData("SHOW CREATE TABLE $table");

                    fputs($file_handle, "-- Usunięcie tabeli" . $structure['Table'] . "\n" . 'DROP TABLE IF EXISTS ' . $structure['Table'] . ';' . "\n\n");
                    fputs($file_handle, "-- Struktura tabeli" . $structure['Table'] . "\n" . $structure['Create Table'] . ';' . "\n\n");

                    /** pobranie liczby rekordow */
                    $row_numbers = $this->getData("SELECT COUNT(*) as sum FROM $table");
                    $row_numbers = $row_numbers['sum'];

                    /** pobieranie kolumn i określanie kolumn */
                    $columns        = $this->getData("SHOW COLUMNS FROM $table", false);
                    $columns_string = null;

                    for($i = 0; $i < count($columns); $i++)
                    {
                        if($i >= 0 && $i < count($columns) - 1) $columns_string .= '`'.$columns[$i]['Field'] . '`,';
                        if($i == count($columns) - 1) $columns_string .= '`'.$columns[$i]['Field'].'`';
                    }

                    /** zapis danych ustawic pobieranie paczek po 250 ? **/
                    /** jeżeli wierszy jest mniej niż 250 */
                    if($row_numbers < 250 && $row_numbers > 0)
                    {
                        if($rows = $this->getData("SELECT * FROM $table", false))
                        {
                            fputs($file_handle, "-- Zrzut danych z tabeli" . $structure['Table'] . "\n");
                            fputs($file_handle, "INS" . "ERT INTO $table ($columns_string) VALUES \n");

                            /** @var konstrukcja wyrażenia */
                            for($i = 0; $i < count($rows); $i++)
                            {
                                $row_str = '(';
                                for($j = 0; $j < count($columns); $j++)
                                {
                                    if($j < count($columns) - 1)
                                    {
                                        $row_str .= "'" . $rows[$i][$columns[$j]['Field']] . "',";
                                    }
                                    else
                                    {
                                        $row_str .= "'" . $rows[$i][$columns[$j]['Field']] . "'";
                                    }
                                }
                                if($i < count($rows) - 1)
                                {
                                    $row_str .= "),\n";
                                }
                                else
                                {
                                    $row_str .= ");\n";
                                }
                                fputs($file_handle, $row_str);
                            }

                            fputs($file_handle, "\n\n");
                        }
                    }
                    else
                    {
                        $start  = 0;
                        $amount = 150;

                        fputs($file_handle, "-- Zrzut danych z tabeli" . $structure['Table'] . "\n");

                        while($rows = $this->getData("SELECT * FROM $table LIMIT $start, $amount", false))
                        {
                            fputs($file_handle, "INS" . "ERT INTO $table ($columns_string) VALUES \n");

                            /** @var konstrukcja wyrażenia */
                            for($i = 0; $i < count($rows); $i++)
                            {
                                $row_str = '(';
                                for($j = 0; $j < count($columns); $j++)
                                {
                                    if($j < count($columns) - 1)
                                    {
                                        $row_str .= "'" . $rows[$i][$columns[$j]['Field']] . "',";
                                    }
                                    else
                                    {
                                        $row_str .= "'" . $rows[$i][$columns[$j]['Field']] . "'";
                                    }
                                }
                                if($i < count($rows) - 1)
                                {
                                    $row_str .= "),\n";
                                }
                                else
                                {
                                    $row_str .= ");\n";
                                }
                                fputs($file_handle, $row_str);
                            }

                            $start += $amount;
                        }
                    }

                }
                else
                {
                    fclose($file_handle);
                    unlink($this->backupDirPath . '/' . $filename . '.sql');
                    view::setAlertPanel('Nieznana tabela jako parametr funkcji','danger');
                    return false;
                }
            }

            fclose($file_handle);
            return true;
        }
    }

    public function inputTablesFromFile($file_path, $msg = false) {

        if(!empty($file_path) && is_file($file_path))
        {
            $file_content = file_get_contents($file_path);

            $_errors = array();

            /** sprawdzenie zawartosci pliku */
            echo "Sprawdzenie zawartości pliku.. ";
            if(!empty($file_content))
            {
                echo "<span class='fa fa-check text-success'></span><br /><br />";
            }
            else
            {
                echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                $_errors[] = 'Niepoprawna zawartość pliku<br />';
            }
            flush();
            ob_flush();

            /** wyodrebnienie zapytan */
            echo "Wyodrębnienie zapytań.. ";
            $queries = explode(";",$file_content);
            unset($file_content);
            if(is_array($queries))
            {
                echo "<span class='fa fa-check text-success'></span><br /><br />";
            }
            else
            {
                echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                $_errors[] = 'Błąd podczas wyodrębniania zapytań<br />';
            }
            flush();
            ob_flush();

            /** wyodrebnienie zapytan */
            echo "Analiza zapytań.. ";
            for($i=0;$i<count($queries);$i++)
            {
                if(trim($queries[$i])=='')
                {
                    unset($queries[$i]);
                }
                else
                {
                    $queries[$i] = trim($queries[$i]);
                }
            }
            $queries = array_merge(array_filter($queries));

            if(!empty($queries) && is_array($queries))
            {
                echo "<span class='fa fa-check text-success'></span><br /><br />";
            }
            else
            {
                echo "<span class='fa fa-ban text-danger'></span><br /><br />";
                $_errors[] = 'Błąd podczas analizy zapytań<br />';
            }
            flush();
            ob_flush();

            /** wykonywanie zapytan */
            echo "Wykonywanie zapytań.. ";
            $this->runQuery("START TRANSACTION");
            for($i=0;$i<count($queries);$i++)
            {
                echo "<blockquote class='source-code source-code600'>".nl2br($queries[$i])."..";
                if(!$this->runQuery($queries[$i]))
                {
                    echo "<span class='fa fa-ban text-danger'></span>";
                    $_errors['queries'][] = 'Błąd podczasy wykonywania zapytania: <i>'.$queries[$i].'</i>';
                }
                else
                {
                    echo "<span class='fa fa-check text-success'></span>";
                }
                echo "</blockquote>";
                flush();
                ob_flush();
            }
            $this->runQuery("ROLLBACK");
            if(empty($_errors))
            {
                if($msg==true)
                echo "<div class='alert alert-success'>Import wykonany poprawnie! <a href='/database/manage' style='font-weight: bold;'>Przejdź dalej</a></div>";
                $this->runQuery("COMMIT");
            }
            else
            {
                if($msg==true)
                echo "<div class='alert alert-danger'>Baza została zaimportowana z błędem! Sprawdź logi powyżej. Należy przywrócić ostatnią dobrą kopię zapasową lub skontaktować się z dostawcą! <a href='/database/manage' style='font-weight: bold;'>Przejdź dalej</a></div>";
                $this->runQuery("ROLLBACK");
            }

            flush();
            ob_flush();

            if(!empty($_errors))
            {
                return $_errors;
            }
            else
            {
                return true;
            }
        }
    }
}