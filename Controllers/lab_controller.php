<?php

class lab_controller extends controller {

    public function standard_list() {

        Permissions::checkPermission('lab_standards', true);

        $View = $this->loadView();
        $View->standard_list();

        $View->render('standard_list');
    }

    public function standard($params) {

        Permissions::checkPermission('lab_standard_details', true);

        $View = $this->loadView();
        $View->standard($params);

        $View->render('standard');
    }

    public function new_standard() {

        Permissions::checkPermission('lab_new_standard', true);

        $View = $this->loadView();
        $View->new_standard();

        $View->render('new_standard');
    }

    public function edit_standard($params) {

        Permissions::checkPermission('lab_standard_edit', true);

        $View = $this->loadView();
        $View->edit_standard($params);

        $View->render('edit_standard');
    }

    public function archivize_standard($params) {

        Permissions::checkPermission('lab_standard_archivize', true);

        $View = $this->loadView();
        $View->archivize_standard($params);
        $View->standard_list();

        $View->render('standard_list');
    }

    public function manage_types($params) {

        Permissions::checkPermission('lab_standard_manage_types', true);

        $View = $this->loadView();
        $View->manage_types($params);

        $View->render('manage_types');
    }

    public function set_deviations($params) {

        Permissions::checkPermission('lab_standard_register_deviations', true);

        $View = $this->loadView();
        $View->set_deviations($params);

        $View->render('set_deviations');
    }

    public function manage_categories($params) {

        Permissions::checkPermission('lab_standard_manage_categories', true);

        $View = $this->loadView();
        $View->manage_categories($params);

        $View->render('manage_categories');
    }

    public function manage_descriptions($params) {

        Permissions::checkPermission('lab_standard_manage_descriptions', true);

        $View = $this->loadView();
        $View->manage_descriptions($params);

        $View->render('manage_descriptions');
    }

    public function delete_type($params) {

        Permissions::checkPermission('lab_standard_delete_types', true);

        $View = $this->loadView();
        $View->delete_type($params);

        $View->render('standard_delete');
    }

    public function delete_category($params) {

        Permissions::checkPermission('lab_standard_delete_categories', true);

        $View = $this->loadView();
        $View->delete_category($params);

        $View->render('standard_delete');
    }

    public function delete_description($params) {

        Permissions::checkPermission('lab_standard_delete_description', true);

        $View = $this->loadView();
        $View->delete_description($params);

        $View->render('standard_delete');
    }

    public function standard_mixes($params) {

        Permissions::checkPermission('lab_standard_register_borders', true);

        $View = $this->loadView();
        $View->standard_mixes($params);

        $View->render('standard_mixes');
    }

    public function settings() {

        Permissions::checkPermission('lab_settings', true);

        $View = $this->loadView();
        $View->settings();

        $View->render('settings');
    }

    public function examinations() {

        Permissions::checkPermission('lab_examination_list', true);

        $View = $this->loadView();
        $View->examinations();

        $View->render('examinations');
    }

    public function examinations_archive($params) {

        Permissions::checkPermission('lab_examination_archive', true);

        if(empty($params) || !checkdate($params[1],1,$params[0]))
        {
            Permissions::forwarding('/lab/examinations_archive/'.date('Y').'/'.date('m'));
        }

        $View = $this->loadView();
        $View->examinations_archive($params);

        $View->render('examinations_archive');
    }

    public function new_type() {

        Permissions::checkPermission('lab_new_examination_type', true);

        $View = $this->loadView();
        $View->new_type();

        $View->render('new_type');
    }

    public function examination_types() {

        Permissions::checkPermission('lab_examination_types', true);

        $View = $this->loadView();
        $View->examination_types();

        $View->render('examination_types');
    }

    public function examination_type($params) {

        Permissions::checkPermission('lab_examination_type', true);

        $View = $this->loadView();
        $View->examination_type($params);

        $View->render('examination_type');
    }

    public function register_curve($params) {

        Permissions::checkPermission('lab_register_curve', true);

        $View = $this->loadView();
        $View->register_curve($params);

        $View->render('register_curve');
    }

    public function schedule_month($params) {

        Permissions::checkPermission('lab_schedule_month', true);

        if(empty($params) || !checkdate($params[1],1,$params[0]))
        {
            Permissions::forwarding('/lab/schedule_month/'.date('Y').'/'.date('m'));
        }

        $View = $this->loadView();
        $View->schedule_month($params);

        $View->render('schedule_month');
    }

    public function schedule_day($params) {

        Permissions::checkPermission('lab_schedule_day', true);

        if(empty($params))
        {
            Permissions::forwarding('/lab/schedule_month/'.date('Y').'/'.date('m'));
        }

        $params = explode("-",$params[0]);

        $View = $this->loadView();
        $View->schedule_day($params);

        $View->render('schedule_day');
    }

    public function delete_examination_type($params) {

        Permissions::checkPermission('lab_archivize', true);

        $View = $this->loadView();
        $View->delete_examination_type($params);
        $View->examination_types();

        $View->render('examination_types');
    }

    public function delete_curve($params) {

        Permissions::checkPermission('lab_delete_curve', true);

        $View = $this->loadView();
        $View->delete_curve($params);
        $View->examination_type($params);

        $View->render('examination_type');
    }

    public function new_examination($params) {

        Permissions::checkPermission('lab_new_examination', true);

        $View = $this->loadView();
        $View->new_examination($params);

        $View->render('new_examination');
    }

    public function examination($params) {

        Permissions::checkPermission('lab_examination_details', true);

        $View = $this->loadView();
        $View->examination($params);

        $View->render('examination');
    }

    public function delete_examination_order($params) {

        Permissions::checkPermission('lab_delete_examination', true);

        $View = $this->loadView();
        $View->delete_examination_order($params);
        $View->examinations();

        $View->render('examinations');
    }

    public function examination_results($params) {

        Permissions::checkPermission('lab_examination_results', true);

        $View = $this->loadView();
        $View->examination_results($params);

        $View->render('examination_results');
    }

    public function run_examination($params) {

        Permissions::checkPermission('lab_run_examination', true);

        $View = $this->loadView();
        $View->run_examination($params);

        $View->render('run_examination');
    }

    public function certificate_list() {

        Permissions::checkPermission('lab_certificate_list', true);

        $View = $this->loadView();
        $View->certificate_list();

        $View->render('certificate_list');
    }

    public function new_certyficate($params) {

        Permissions::checkPermission('lab_register_certificate', true);

        $View = $this->loadView();
        $View->new_certyficate($params);
        $View->certificate_list();

        $View->render('certificate_list');
    }

    public function show_certificate($params) {

        Permissions::checkPermission('lab_show_certificate', true);

        $View = $this->loadView();
        $View->show_certificate($params);
    }


    /** AJAX */
    public function ANDROIDgetSamples() {

        Permissions::checkPermission(true, true);

        $Model = $this->loadModel();
        $temp_samples = $Model->getData("SELECT lab_examination_orders.*,
                                        lab_examination_samples.collection_date,
                                        lab_examination_samples.user,
                                        lab_examination_samples.number AS 'sample_number',
                                        lab_examination_samples.status AS 'sample_sample_status',
                                        lab_examination_samples.method AS 'sample_method',
                                        lab_examination_types.symbol,
                                        crm_client_buildings.city AS 'b_city',
                                        crm_client_buildings.number AS 'b_streat_number',
                                        crm_client_buildings.post_code AS 'b_post_code',
                                        crm_client_buildings.str_type AS 'b_streat_type',
                                        crm_client_buildings.street AS 'b_streat',
                                        crm_client_contacts.comments AS 'contact_description',
                                        crm_client_contacts.description AS 'contact_name',
                                        crm_client_contacts.phone AS 'contact_phone',
                                        crm_clients_list.name2 AS 'client_name',
                                        lab_examination_types.standard
                                      FROM lab_examination_orders, lab_examination_samples, lab_examination_types, crm_client_buildings, crm_clients_list, crm_client_contacts
                                      WHERE lab_examination_orders._sample = lab_examination_samples.id
                                      AND lab_examination_orders._examination_type = lab_examination_types.id
                                      AND lab_examination_orders.status = 0
                                      AND lab_examination_orders._client_building = crm_client_buildings.id
                                      AND lab_examination_orders._client_contact = crm_client_contacts.id
                                      AND lab_examination_orders._client = crm_clients_list.id
                                      AND lab_examination_orders.sample_status = 0
                                      AND lab_examination_samples.method = 0
                                      ORDER BY lab_examination_orders.examination_date ASC", false);

        if(!empty($temp_samples))
        {
            $samples['samples'] = $temp_samples;
            $samples['success'] = 1;
        }
        else
        {
            $samples['success'] = 0;
            $samples['message'] = "No products found";
        }
        echo json_encode($samples);
    }

    public function AJAXgetDescriptions() {

        Permissions::checkPermission(true, true);

        $Model = $this->loadModel();
        echo json_encode($Model->getDescriptions($_POST['standard']));
    }

    public function AJAXgetTypes() {

        Permissions::checkPermission(true, true);

        $Model = $this->loadModel();
        echo json_encode($Model->getTypes($_POST['standard']));
    }

    public function AJAXgetCategories() {

        Permissions::checkPermission(true, true);

        $Model = $this->loadModel();
        echo json_encode($Model->getCategories($_POST['standard']));
    }

    public function AJAXgetClientBuildings() {

        Permissions::checkPermission(true, true);

        $Model = $this->loadModel('crm_model');
        echo json_encode($Model->getBuildings($_POST['client'],null,1));
    }

    public function AJAXgetClientContacts() {

        Permissions::checkPermission(true, true);

        $Model = $this->loadModel('crm_model');
        echo json_encode($Model->getContacts($_POST['client'],null,1));
    }

    public function AJAXgetNumOfExaminationsInDate() {

        Permissions::checkPermission(true, true);

        $Model = $this->loadModel();
        if($Model->settingsGetTestsPerDay()['tests_per_day']>count($Model->getExaminationsInDate($_POST['year'],$_POST['month'],$_POST['day'])))
        {
            echo 'true';
        }
        else
        {
            echo 'false';
        }
    }
}