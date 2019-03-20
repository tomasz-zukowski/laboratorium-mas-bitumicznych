<?php

/**
 * Class Router Pobiera dane z adresu i wywoluje odpowiedni kontroler z akcją
 * @package router
 */
class Router
{

    //Kontroler i akcja
    public static $controller;
    public static $action;

    //Parametry array i string
    public static $params;
    public static $params_line;

    /**
     * Konstruktor - ustawianie kontrolera, akcji i parametrów
     */
    public function __construct()
    {
        if(!empty($_GET['rt']))
        {
            $URL = explode("/", $_GET['rt'], 3);

            self::$controller  = (isset($URL[0])) ? trim(strtolower($URL[0])) : "";
            self::$action      = (isset($URL[1])) ? trim(strtolower($URL[1])) : "";
            self::$params_line = (isset($URL[2])) ? trim($URL[2]) : "";

            if(!empty(self::$params_line))
            {
                self::$params = explode("/", self::$params_line);
            }
        }

        Router::emptyFilling();

    }

    /**
     * Ustawienie domyslnego kontrolera w przypadku braku
     */
    private function emptyFilling() {

        if( empty( self::$controller ) ) {

            if(isset($_SESSION['id']))
            {
                $path = explode( '/', startupDIR_logg );
            }
            else
            {
                $path = explode( '/',startupDIR_unlogg);
            }

            self::$controller 	= $path[1];
            self::$action 		= $path[2];

        }
        else {

            self::$controller 	= str_replace( ' ', '_', self::$controller );
            self::$action 		= str_replace( ' ', '_', self::$action );

        }

    }

    /**
     * Pobieranie kontrolera
     * @return string
     */
    public static function getController()
    {
        $path = 'Controllers/' . self::$controller . '_controller.php';

        /** Jeżeli kontroler jest niepusty */
        if(!empty(self::$controller) && file_exists($path))
        {
            include_once $path;

            /** Sprawdzenie czy istnieje akcja */
            if(method_exists(self::$controller."_controller", self::$action))
            {
                return self::$controller."_controller";
            }
        }

        self::$controller = 'errors';
        self::$action = 'index';
        include_once 'Controllers/errors_controller.php';
        return 'errors_controller';
    }

    /**
     * Pobieranie modelu
     * @return string
     */
    public static function getModel()
    {
        if(!empty(self::$controller))
        {
            return self::$controller."_model";
        }

        return 'errors_model';
    }

    /**
     * Pobieranie widoku
     * @return string
     */
    public static function getView()
    {
        if(!empty(self::$controller))
        {
            return self::$controller."_view";
        }

        return 'errors_view';
    }

    /**
     * Pobieranie akcji
     * @return string
     */
    public static function getAction()
    {
        if(!empty(self::$action))
        {
            return self::$action;
        }

        return 'index';
    }

    /**
     * Pobieranie parametrów
     * @param bool $array
     * @return array|string
     */
    public static function getParams($array = true)
    {
        if(!empty(self::$params))
        {
            if($array)
            {
                return self::$params;
            }
            else
            {
                return self::$params_line;
            }
        }

        return array();
    }

}