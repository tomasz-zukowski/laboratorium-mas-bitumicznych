<?php

class home_controller extends controller
{
    public function index()
    {
        Permissions::checkPermission(true, true);

        $View = $this->loadView();
        $View->index();
        $View->render('index');
    }

}
