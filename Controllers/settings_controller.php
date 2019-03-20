<?php

class settings_controller extends controller {

    public function review() {

        Permissions::checkPermission('settings', true);

        $View = $this->loadView();
        $View->review();
        $View->render('review');

    }

    public function module($params) {

        Permissions::checkPermission('settings_modules', true);

        $View = $this->loadView();

        $module_name = $params[0];

        $View->module($module_name);
        $View->render('module');
    }

}