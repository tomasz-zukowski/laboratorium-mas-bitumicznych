<?php

class settings_model extends model {

    public function getModules() {

        /** pozyskanie listy modułów */
        if(Permissions::checkModule('modules'))
        {
            $Model = $this->loadModel('modules_model');
            return $Model->getModulesList(false);
        }

        return false;
    }

    /**
     * Sprawdzanie czy moduł istnieje i dołączenie ustawień modułu do okna settings
     * @param $param - nazwa modulu do dołączenia w oknie setting
     * @return bool|string - sciezka dolaczenia pliku
     */
    public function module($param) {

        if(Permissions::checkModule($param))
        {
            $file_name = 'settings_pages/'.$param;
            return $file_name;
        }
        else
        {
            return 'settings_pages/404';
        }

    }

}