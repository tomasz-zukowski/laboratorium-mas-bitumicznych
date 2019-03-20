<?php

class modules_view extends view {

    public function manage() {

        $Model = $this->loadModel();

        $this->set('modules',$Model->getModulesList());

        $this->setTitle('Zarządzanie modułami');
    }

    public function switch_active($params) {

        $Model = $this->loadModel();
        $module = $Model->getModule($params[0]);

        if(empty($_POST))
        {
            $this->setPromptWindow('confirmation','Zmiana statusu modułu?','Czy napewno chcesz zmienić status aktuwności modułu?'.
            '<div class="text-right"><input class="btn btn-sm btn-default" type="submit" name="no" value="Anuluj" /> '.
            '<input class="btn btn-sm btn-success" type="submit" name="yes" value="Zmień" /> </div>',
            '',false,false,false,null,null,'post','/modules/switch_active/'.$params[0]);
        }
        if(isset($_POST['yes']))
        {
            $Model->switchModuleStatus($params[0]);
        }
        elseif(isset($_POST['no']))
        {
            Permissions::forwarding('/modules/manage');
        }

        $this->set('modules',$Model->getModulesList());
        $this->setTitle('Zarządzanie modułami');
    }

    public function preinstall() {

        $this->setTitle('Instalacja modułu');
    }

    public function install() {

        $Model = $this->loadModel();

        if(!empty($_POST) || !empty($_FILES))
        {
            $file_name = $_FILES['package_file']['name'];
            $file_path = $_FILES['package_file']['tmp_name'];


            if(Permissions::checkModule(substr($file_name,0,-4)))
            {
                view::setAlertPanel('Ten moduł jest już zainstalowany w aplikacji!','danger','/modules/manage/',5);
            }

            $this->set('file_name',$file_name);
            $this->set('file_path',$file_path);
            $this->set('file_key',$_POST['package_key']);
        }

        $this->Model = $Model;
        $this->setTitle('Postęp instalacji');
    }

    public function install_app() {

        $Model = $this->loadModel();
        $Model->checkStartSQLFile();

        $this->Model = $Model;
        $this->setTitle('Instalacja aplikacji');
    }
}