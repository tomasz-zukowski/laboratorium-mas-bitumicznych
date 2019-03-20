<?php

class crm_view extends view {

    public function review() {

        $Model = $this->loadModel();

        if(!isset($_GET['search']))
        {
            $this->set('list',$Model->getClients(null, 1));
        }
        else
        {
            $this->set('list',$Model->findClients($_GET['search'], 1));
        }
        $this->setPromptWindow('search','Wyszukiwanie klientów','Wprowadź szukaną frazę: <br /><br /><input type="text" name="search" class="form-control" /><a class="help-block">Zakres przeszukiwania: nazwa, numer NIP.</a> ',null,true,true,true,'info','default','GET');
        $this->setTitle('Lista klientów');
    }

    public function archive() {

        $Model = $this->loadModel();

        if(empty($_GET['pgn_start']))
            $_GET['pgn_start']=1;

        $pgn = new pagination($Model->getClients(null, 0));
        $this->set('list', $pgn->getPage($_GET['pgn_start']));
        $this->set('_pgn',$pgn->render());

        $this->setTitle('Lista klientów archiwalnych');
    }

    public function new_client() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->newClient($_POST);
        }

        $str_type_list = array( array('name'=>'ulica','value'=>'ul'),
                                array('name'=>'aleja','value'=>'al.'),
                                array('name'=>'plac','value'=>'pl.'),
                                array('name'=>'rondo','value'=>'rondo'),
                                array('name'=>'osiedle','value'=>'os.'),
                                array('name'=>'---','value'=>' '));

        $this->set('str_type_list',$str_type_list);
        $this->set('list',$Model->getClients());
        $this->setTitle('Lista klientów');
    }

    public function edit_client($params) {

        $Model = $this->loadModel();

        if(!$Model->getClients($params[0]))
        {
            Permissions::forwarding("/crm/review");
        }

        if(!empty($_POST))
        {
            $Model->editClient($params[0], $_POST);
        }

        $this->set('client_info',$Model->getClients($params[0]));
        $str_type_list = array( array('name'=>'ulica','value'=>'ul'),
            array('name'=>'aleja','value'=>'al.'),
            array('name'=>'plac','value'=>'pl.'),
            array('name'=>'rondo','value'=>'rondo'),
            array('name'=>'osiedle','value'=>'os.'),
            array('name'=>'---','value'=>' '));

        $this->set('str_type_list',$str_type_list);
        $this->set('id',$params[0]);
        $this->setTitle('Edycja klienta');
    }

    public function client($params) {

        $Model = $this->loadModel();

        if(!$Model->getClients($params[0]))
        {
            Permissions::forwarding("/crm/review");
        }

        if(Permissions::checkModule('lab'))
        {
            $LAB_model = $this->loadModel('lab_model');
            $this->set('mixtures',$Model->searchClientExaminations($LAB_model->getExaminations(),$params[0]));
        }

        $this->set('client_info',$Model->getClients($params[0]));
        $this->set('client_contacts',$Model->getContacts($params[0],null,1));
        $this->set('client_buildings',$Model->getBuildings($params[0],null,1));
        $this->set('client',$Model->getClients());
        $this->setTitle('Widok szczegółowy klienta');
    }

    public function new_building($params) {

        $Model = $this->loadModel();

        if(!$Model->getClients($params[0]))
        {
            Permissions::forwarding("/crm/review");
        }

        if(!empty($_POST))
        {
            $Model->newBuilding($params[0],$_POST);
        }

        $str_type_list = array( array('name'=>'ulica','value'=>'ul'),
            array('name'=>'aleja','value'=>'al.'),
            array('name'=>'plac','value'=>'pl.'),
            array('name'=>'rondo','value'=>'rondo'),
            array('name'=>'osiedle','value'=>'os.'),
            array('name'=>'---','value'=>' '));
        $this->set('str_type_list',$str_type_list);
        $this->set('client_info',$Model->getClients($params[0]));
        $this->set('id',$params[0]);
        $this->setTitle('Rejestracja nowej budowy');
    }

    public function edit_building($params) {

        $Model = $this->loadModel();

        if(!$Model->getClients($params[0]) || !$Model->getBuildings($params[0],$params[1]))
        {
            Permissions::forwarding("/crm/review");
        }

        if(!empty($_POST))
        {
            $Model->editBuilding($params[0], $params[1], $_POST);
        }

        $str_type_list = array( array('name'=>'ulica','value'=>'ul'),
            array('name'=>'aleja','value'=>'al.'),
            array('name'=>'plac','value'=>'pl.'),
            array('name'=>'rondo','value'=>'rondo'),
            array('name'=>'osiedle','value'=>'os.'),
            array('name'=>'---','value'=>' '));
        $this->setPromptWindow('delete', 'Usuwanie budowy', 'Czy napewno chcesz usunąć wybraną budowę?', '', true, true, true, 'danger', 'default', 'post', '/crm/delete_building/'.$params[0].'/'.$params[1]);
        $this->set('str_type_list',$str_type_list);
        $this->set('building',$Model->getBuildings($params[0],$params[1]));
        $this->set('client_id',$params[0]);
        $this->setTitle('Edycja budowy');
    }

    public function delete_building($params) {

        $Model = $this->loadModel();

        if(!$Model->getClients($params[0]) || !$Model->getBuildings($params[0],$params[1]))
        {
            Permissions::forwarding("/crm/review");
        }

        $Model->deleteBuilding($params[0], $params[1]);
        $this->setTitle('Usuwanie budowy');
    }

    public function new_contact($params) {

        $Model = $this->loadModel();

        if(!$Model->getClients($params[0]))
        {
            Permissions::forwarding("/crm/review");
        }

        if(!empty($_POST))
        {
            $Model->newContact($params[0], $_POST);
        }

        $this->set('id',$params[0]);
        $this->setTitle('Rejestracja nowego kontaktu');
    }

    public function edit_contact($params) {

        $Model = $this->loadModel();

        if(!$Model->getClients($params[0]) || !$Model->getContacts($params[0],$params[1]))
        {
            Permissions::forwarding("/crm/review");
        }

        if(!empty($_POST))
        {
            $Model->editContact($params[0], $params[1], $_POST);
        }

        $this->setPromptWindow('delete', 'Usuwanie kontaktu', 'Czy napewno chcesz usunąć wybrany kontakt?', '', true, true, true, 'danger', 'default', 'post', '/crm/delete_contact/'.$params[0].'/'.$params[1]);
        $this->set('contact',$Model->getContacts($params[0],$params[1]));
        $this->set('client_id',$params[0]);
        $this->setTitle('Edycja kontaktu');
    }

    public function delete_contact($params) {

        $Model = $this->loadModel();

        if(!$Model->getClients($params[0]) || !$Model->getContacts($params[0],$params[1]))
        {
            Permissions::forwarding("/crm/review");
        }

        $Model->deleteContact($params[0], $params[1], $_POST);
        $this->setTitle('Usuwanie kontaktu');
    }
}