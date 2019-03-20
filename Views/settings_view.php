<?php

class settings_view extends view {

    public function review() {

        $Model = $this->loadModel();
        $this->set('modules_list',$Model->getModules());
        $this->set('header','Ustawienia');
        $this->set('header_description','W celu konfiguracji ustawień należy wybrać odpowiedni moduł z panelu po prawej stronie.');
        $this->setTitle('Ustawienia');
    }

    public function module($module_name) {

        $Model = $this->loadModel();
        $this->set('module_settings_path',$Model->module($module_name));
        $this->set('module_name',$module_name);
        $this->setTitle('Ustawienia modułu '.$module_name);
    }

}