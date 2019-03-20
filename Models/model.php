<?php

/**
 * Coś nie tak przy wykonywaniu zapytania delete * from pf w runQuery
 * Class model
 */
abstract class model
{
    protected $pdo;

    /**
     * Połączenie i obsługa błędów związana z bazą danych
     */
    public function __construct()
    {

        try
        {
            require 'Conf/database_mysql.php';

            $this->pdo = new PDO('mysql:host=' . $settings['host'] . ';dbname=' . $settings['dbase'], $settings['user'], $settings['pass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try
            {
                if(!$this->getData("SELECT 1 FROM _users_list"))
                {
                    throw new Exception('No table _users_list');
                }
            } catch(Exception $e)
            {
                if(isset($_SESSION['id']) && !strpos($_SERVER['REQUEST_URI'],'/modules/install_app'))
                {
                    Permissions::forwarding('/users/log_out/');
                }
                if(strpos($_SERVER['REQUEST_URI'],'/modules/install_app')===false)
                {
                    view::setAlertPanel('Struktura bazy danych jest niepoprawna lub aplikacja nie została zainstalowana! <a href="/modules/install_app/">Instalator</a>','danger',null, null);
                }
            }

        } catch(PDOException $e)
        {
            if(isset($_SESSION['id']))
            {
                Permissions::forwarding('/users/log_out/');
            }
            if(strpos($_SERVER['REQUEST_URI'],'/modules/install_app')===false)
            {
                view::setAlertPanel('Nie udało się połączyć z bazą danych! <a href="/modules/install_app/">Instalator</a>', 'danger', null, null);
            }
        }
    }

    /**
     * @param null $query
     * @param bool $mode
     * @return array|bool|null
     */
    public function getData($query = null, $mode = true)
    {
        try
        {
            $result = $this->pdo->query($query);

            if(!empty($result))
            {
                if($mode==true)
                {
                    $data = null;
                    while($row = $result->fetch(PDO::FETCH_ASSOC))
                    {
                        $data[] = $row;
                    }

                    if( count( $data ) == 1 ) $data = $data[0];
                }
                else
                {
                    $data = null;
                    while($row = $result->fetch(PDO::FETCH_ASSOC))
                    {
                        $data[] = $row;
                    }
                }

                return $data;
            }

        } catch(PDOException $e)
        {
            //echo $e->getMessage();
            return false;
        }
        return false;
    }

    /**
     * @param $query
     * @return bool
     */
    public function runQuery($query)
    {
        try
        {
            if($this->pdo->query($query))
            {
                return true;
            }
        }
        catch(PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function loadModel($name=null)
    {
        (empty($name)) ? $model_name = Router::getModel() : $model_name = $name;
        $path       = 'Models/' . $model_name . '.php';
        try
        {
            if(is_file($path))
            {
                include $path;
                $Model = new $model_name();
            }
            else
            {
                throw new Exception('Cant open file');
            }
        } catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
            exit;
        }

        return $Model;
    }
}