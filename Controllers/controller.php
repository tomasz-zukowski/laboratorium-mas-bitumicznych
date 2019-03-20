<?php

abstract class controller
{
    public function loadView($name=null)
    {
        (empty($name)) ? $view_name = Router::getView() : $view_name = $name;
        $path      = 'Views/' . $view_name . '.php';

        try
        {
            if(is_file($path))
            {
                include $path;
                $View = new $view_name();
            }
            else
            {
                throw new Exception('Cant find View file');
            }
        } catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
            exit;
        }

        return $View;
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
                throw new Exception('Cant find Model file');
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