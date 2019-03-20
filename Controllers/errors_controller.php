<?php

class errors_controller extends controller {

    public function index()
    {
        $View = $this->loadView();
        $View->index();
        $View->render('index');
    }

    public function access_denied()
    {
        $View = $this->loadView();
        $View->access_denied();
        $View->render('access_denied');
    }

}