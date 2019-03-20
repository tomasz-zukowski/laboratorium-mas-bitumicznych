<?php

class navigation_view extends view
{
    public function links_list() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->newLink($_POST);
        }

        $Model->setLinks();

        $this->set('permissions',$Model->getPermissionsList());
        $this->set('parents',$Model->getParents());
        $this->set('links_list',$Model->getLinks());
        $this->setTitle("Zarządzanie linkami nawigacyjnymi");
    }

    public function edit_link($params) {

        $Model = $this->loadModel();

        $Model->setLinks();

        if(!$Model->getLinks($params[0]))
        {
            Permissions::forwarding('/navigation/links_list/');
        }

        if(!empty($_POST))
        {
            $Model->editLink($_POST);
        }

        $this->set('permissions',$Model->getPermissionsList());
        $this->set('is_parent', $Model->hasChildren($params[0]));
        $this->set('parents',$Model->getParents());
        $this->set('link',$Model->getLinks($params[0]));
        $this->setPromptWindow('delete','Usuwanie linku nawigacyjnego','Czy napewno chcesz usunąć ten link?','',true,true,true,'danger','default','post','/navigation/delete_link/'.$params[0]);
        $this->setTitle('Edycja linku nawigacyjnego');
    }

    public function delete_link($params) {

        $Model = $this->loadModel();
        $Model->setLinks();

        if(!$Model->getLinks($params[0]))
        {
            Permissions::forwarding('/navigation/links_list/');
        }

        $Model->deleteLink($params[0]);
        $this->setTitle('Usuwanie linku nawigacyjnego');
    }
}