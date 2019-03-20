<?php

class users_view extends view {

    public function log_in() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->log_in($_POST['u_login'],$_POST['u_haslo']);
        }

        $this->set('hello_msg','Witaj na stronie logowania. Aby przejść dalej i korzystać z naszej aplikacji musisz się zalogować za pomocą loginu i hasła.');
        $this->setTitle('Logowanie');

    }

    public function manage() {

        $Model = $this->loadModel();

        $users = $Model->getUsers();

        if(empty($_GET['pgn_start']))
            $_GET['pgn_start']=1;

        $pgn = new pagination($users);
        $this->set('users_info', $pgn->getPage($_GET['pgn_start']));

        //$this->set('users_info',$Model->getUsers());
        $this->set('_pgn',$pgn->render());
        $this->setTitle('Zarządzanie użytkownikami');

    }

    public function details($params) {

        $Model = $this->loadModel();

        $user_info = $Model->getUsers($params[0]);

        if(!$user_info)
        {
            Permissions::forwarding('/users/manage/');
        }

        $this->set('id',$user_info['id']);
        $this->set('forename',$user_info['forename']);
        $this->set('surname',$user_info['surname']);
        $this->set('email',$user_info['email']);
        $this->set('login',$user_info['login']);
        $this->set('group',$user_info['group_name']);

        $this->setTitle($user_info['forename'].' '.$user_info['surname']);

    }

    public function new_user() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->newUser($_POST);
        }

        $this->set('groups',$Model -> getGroups(null, true));

        $this->setTitle('Nowy użytkownik');
    }

    public function edit_user($params) {

        $Model = $this->loadModel();

        $user_info = $Model->getUsers($params[0]);

        if(!$user_info)
        {
            Permissions::forwarding('/users/manage/');
        }

        if(!empty($_POST))
        {
            $Model->editUser($_POST, $params[0]);
        }

        $Rights_model = $this->loadModel('rights_model');

        $this->set('id',$user_info['id']);
        $this->set('forename',$user_info['forename']);
        $this->set('surname',$user_info['surname']);
        $this->set('email',$user_info['email']);
        $this->set('login',$user_info['login']);
        $this->set('group',$user_info['group']);
        $this->set('groups',$Model->getGroups(null, true));
        $this->set('rights_tree',$Rights_model->getRightsFiles(null,2,$params[0]));
        $this->setPromptWindow('delete', 'Usuwanie użytkownika', 'Czy napewno chcesz usunąć wybranego użytkownika?', '', true, true, true, 'danger', 'default', 'post', '/users/delete_user/' . $params[0]);

        $this->setTitle('Edycja - '. $user_info['forename'].' '.$user_info['surname']);

    }

    public function edit_profil() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->editUser($_POST, $_SESSION['id']);
        }

        $user_info = $Model->getUsers($_SESSION['id']);

        $this->set('id',$user_info['id']);
        $this->set('forename',$user_info['forename']);
        $this->set('surname',$user_info['surname']);
        $this->set('email',$user_info['email']);
        $this->set('login',$user_info['login']);

        $this->setTitle('Edycja profilu - '. $user_info['forename'].' '.$user_info['surname']);

    }

    public function groups() {

        $Model = $this->loadModel();

        $groups = $Model->getGroups();

        if(empty($_GET['pgn_start']))
            $_GET['pgn_start']=1;

        $pgn = new pagination($groups);
        $this->set('groups', $pgn->getPage($_GET['pgn_start']));
        $this->set('_pgn',$pgn->render());

        $this->setTitle('Zarządzanie grupami użytkowników');
    }

    public function edit_group($params) {

        $Model = $this->loadModel();

        if(empty($params)) $params[0] = 0;

        if(!$Model->getGroups($params[0]))
        {
            Permissions::forwarding('/users/groups/');
        }

        if(!empty($_POST))
        {
            $Model->editGroup($_POST,$params[0]);
        }

        $Rights_model = $this->loadModel('rights_model');

        $this->set('users',$Model->getUsers(null,$params[0]));
        $this->set('group',$Model->getGroups($params[0]));
        $this->set('rights_tree',$Rights_model->getRightsFiles(null,3,$params[0]));
        $this->setPromptWindow('delete', 'Usuwanie grupy użytkowników', 'Czy napewno chcesz usunąć wybraną grupę?', '', true, true, true, 'danger', 'default', 'post', '/users/delete_group/' . $params[0]);

        $this->setTitle('Edycja grupy użytkowników');
    }

    public function new_group() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->newGroup($_POST);
        }

        $this->setTitle('Rejestracja nowej grupy użytkowników');
    }

    public function delete_user($params) {

        $Model = $this->loadModel();

        if(!$Model->getUsers($params[0]))
        {
            Permissions::forwarding('/users/manage/');
        }

        $Model->deleteUser($params[0]);
        $this->setTitle('Usuwanie użytkownika');
    }

    public function delete_group($params) {

        $Model = $this->loadModel();

        if(!$Model->getGroups($params[0]))
        {
            Permissions::forwarding('/users/groups/');
        }

        $Model->deleteGroup($params[0]);
        $this->setTitle('Usuwanie grupy użytkowników');
    }

}