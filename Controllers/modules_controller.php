<?php
class modules_controller extends controller {

    public function manage() {

        Permissions::checkPermission('modules_list', true);

        $View = $this->loadView();
        $View->manage();
        $View->render('manage');
    }

    public function preinstall() {

        Permissions::checkPermission('modules_new_one', true);

        $View = $this->loadView();
        $View->preinstall();
        $View->render('preinstall');
    }

    public function install() {

        Permissions::checkPermission('modules_new_one', true);

        $View = $this->loadView();
        $View->install();
        $View->render('install');
    }

    public function switch_active($params) {

        Permissions::checkPermission('modules_change_status', true);

        $View = $this->loadView();
        $View->switch_active($params);
        $View->render('manage');
    }

    /**
     * Instalator aplikacji
     */
    public function install_app() {

        $View = $this->loadView();
        $View->install_app();
        $View->render('install_app');
    }

}