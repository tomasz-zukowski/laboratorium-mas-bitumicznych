<?php

setlocale( LC_ALL, 'pl_PL', 'polish_pol', 'polish' );

include 'Conf/sessions_param.php';
include 'Router.class.php';
include 'Permissions.class.php';
include 'Controllers/controller.php';
include 'Views/view.php';
include 'Models/model.php';
include 'Libs/Classes/validation.class.php';
include 'Libs/Classes/form.class.php';
include 'Libs/Classes/pagination.class.php';
include 'Libs/Classes/others.class.php';

define( "RIGHTS_PAGES","Others/Modules_RIGHTS");
define( "MODULES_DB_PAGES","Others/Modules_DB");
define( "startupDIR_logg", "/home/index" );
define( "startupDIR_unlogg","/users/log_in" );
define( "PATH", 'http://'.$_SERVER['HTTP_HOST'] );
define( "SWAP_FILE", 'Others' );

?>