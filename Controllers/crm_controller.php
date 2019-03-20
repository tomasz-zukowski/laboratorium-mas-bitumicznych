<?php

class crm_controller extends controller {

	public function review() {

        Permissions::checkPermission('crm_review', true);

        $View = $this->loadView();
        $View->review();

        $View->render('review');
    }

    public function archive() {

        Permissions::checkPermission('crm_archive', true);

        $View = $this->loadView();

        $View->archive();

        $View->render('archive');
    }

    public function new_client() {

        Permissions::checkPermission('crm_new_one', true);

        $View = $this->loadView();
        $View->new_client();

        $View->render('new_client');
    }

    public function edit_client($params) {

        Permissions::checkPermission('crm_edit', true);

        $View = $this->loadView();
        $View->edit_client($params);

        $View->render('edit_client');
    }

    public function client($params) {

        Permissions::checkPermission('crm_details', true);

        $View = $this->loadView();
        $View->client($params);

        $View->render('client');
    }

    public function new_building($params) {

        Permissions::checkPermission('crm_new_building', true);

        $View = $this->loadView();
        $View->new_building($params);

        $View->render('new_building');
    }

    public function edit_building($params) {

        Permissions::checkPermission('crm_edit_building', true);

        $View = $this->loadView();
        $View->edit_building($params);

        $View->render('edit_building');
    }

    public function delete_building($params) {

        Permissions::checkPermission('crm_delete_build', true);

        $View = $this->loadView();
        $View->delete_building($params);
        $View->client($params);

        $View->render('client');
    }

    public function new_contact($params) {

        Permissions::checkPermission('crm_new_contact', true);

        $View = $this->loadView();
        $View->new_contact($params);

        $View->render('new_contact');
    }

    public function edit_contact($params) {

        Permissions::checkPermission('crm_edit_contact', true);

        $View = $this->loadView();
        $View->edit_contact($params);

        $View->render('edit_contact');
    }

    public function delete_contact($params) {

        Permissions::checkPermission('crm_delete_contact', true);

        $View = $this->loadView();
        $View->delete_contact($params);
        $View->client($params);

        $View->render('client');
    }

}