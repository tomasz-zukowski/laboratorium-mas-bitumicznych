<?php

class users_controller extends controller
{
    public function log_in()
    {
        if(empty($_SESSION['id']))
        {
            $View = $this->loadView();
            $View->log_in();
            $View->render('log_in');
        }
        else
        {
            header('Location: '.startupDIR_logg);
        }
    }

    public function log_out()
    {
        session_destroy();
        header('Location: '.startupDIR_unlogg);
        exit;
    }

    public function manage()
    {
        Permissions::checkPermission('users_manage', true);

        $View = $this->loadView();
        $View->manage();

        $View->render('manage');
    }

    public function details($params)
    {
        Permissions::checkPermission('users_details', true);

        $View = $this->loadView();
        $View->details($params);

        $View->render('details');
    }

    public function new_user()
    {
        Permissions::checkPermission('users_new_one', true);

        $View = $this->loadView();
        $View->new_user();

        $View->render('new_user');
    }

    public function edit_user($params)
    {
        Permissions::checkPermission('users_edit',true);

        $View = $this->loadView();
        $View->edit_user($params);

        $View->render('edit_user');
    }

    public function edit_profil()
    {
        Permissions::checkPermission(true,true);

        $View = $this->loadView();
        $View->edit_profil();

        $View->render('edit_profil');
    }

    public function groups() {

        Permissions::checkPermission('users_groups', true);

        $View = $this->loadView();
        $View->groups();

        $View->render('groups');
    }

    public function edit_group($params) {

        Permissions::checkPermission('users_group_edit', true);

        $View = $this->loadView();
        $View->edit_group($params);

        $View->render('edit_group');
    }

    public function new_group() {

        Permissions::checkPermission('users_group_new', true);

        $View = $this->loadView();
        $View->new_group();

        $View->render('new_group');
    }

    public function delete_user($params)
    {
        Permissions::checkPermission('users_delete', true);

        $View = $this->loadView();
        $View->delete_user($params);
        $View->manage();

        $View->render('manage');
    }

    public function delete_group($params)
    {
        Permissions::checkPermission('users_group_delete', true);

        $View = $this->loadView();
        $View->delete_group($params);
        $View->groups();

        $View->render('groups');
    }
}