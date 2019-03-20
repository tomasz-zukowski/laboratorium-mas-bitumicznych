<?php

class rights_view extends view {

    public function defaults() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->saveDefaultRights($_POST);
        }

        $this->set('rights_tree',$Model->getRightsFiles(null,1));
        $this->setTitle('Uprawnienia domyślne');
    }

}