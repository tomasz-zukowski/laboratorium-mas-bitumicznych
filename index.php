<?php

include 'init.php';

$URL = new Router();

$controller_name = $URL->getController();

$Controller = new $controller_name();

$action_name = $URL->getAction();

$Controller->$action_name($URL->getParams());

?>