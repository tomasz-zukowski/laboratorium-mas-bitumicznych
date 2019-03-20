<?php

class lab_view extends view {

    public $sieves_set = array('S063' => '0,063', 'S125' => '0,125', 'S2' => '2,000', 'S4' => '4,000', 'S5' => '5,600', 'S8' => '8,000', 'S11' => '11,200', 'S16' => '16,000', 'S22' => '22,400', 'S31' => '31,500', 'S45' => '45,000');

    public function standard_list() {

        $Model = $this->loadModel();

        $this->set('list',$Model->getStandards());
        $this->setTitle('Lista standardów');
    }

    public function new_standard() {

        if(!empty($_POST))
        {
            $Model = $this->loadModel();
            $Model->newStandard($_POST);
        }
        $this->setTitle('Rejestracja nowego standardu');
    }

    public function standard($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        $this->set('types',$Model->getTypes($params[0]));
        $this->set('descriptions',$Model->getDescriptions($params[0]));
        $this->set('categories',$Model->getCategories($params[0]));
        $this->set('standard_info',$Model->getStandards($params[0]));
        $this->set('deviations',$Model->getDeviations($params[0]));
        $this->set('model',$Model);
        $this->setTitle('Widok szczegółowy standardu');
    }

    public function edit_standard($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        $this->set('info',$Model->getStandards($params[0]));

        if(!empty($_POST))
        {
            $Model->editStandard($params[0],$_POST);
        }

        $this->setPromptWindow('archivize_standard',
            'Czy napewno usunąć typ?',
            'Czy napewno chcesz zarchiwizować standard?<br /><br />Operacji tej nie można cofnąć!'.
            '<input type="hidden" name="confirm" value="yes" /> ',
            '',true,true,true,'danger','default','POST','/lab/archivize_standard/'.$params[0]);
        $this->setTitle('Edycja standardu');
    }

    public function archivize_standard($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        if(!empty($_POST))
        {
            $Model->archivizeStandard($params[0]);
        }
        $this->setTitle('Archiwizacja standardu');
    }

    public function manage_types($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        if(!empty($_POST))
        {
            $Model->newType($params[0],$_POST);
        }

        $this->set('standard_info',$Model->getStandards($params[0]));
        $this->set('list',$Model->getTypes($params[0]));
        $this->setTitle('Zarządzanie typami');
    }

    public function set_deviations($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        if(!empty($_POST))
        {
            $Model->setDeviations($params[0],$_POST);
        }

        $this->set('deviations',$Model->getDeviations($params[0]));
        $this->set('standard',$Model->getStandards($params[0]));
        $this->setTitle('Ustawianie odchyłek');
    }

    public function delete_type($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        if(empty($_POST))
        {
            $standard = $Model->getStandards($params[0]);
            $type = $Model->getTypes($params[0],$params[1]);
            $this->setPromptWindow('confirmation',
                'Czy napewno usunąć typ?',
                'Czy napewno chcesz usunąć typ <b>'.$type['type'].'</b> ze standardu <b>'.$standard['name'].'</b>?'.
                '<div class="text-right"><input class="btn btn-sm btn-default" type="submit" name="no" value="Anuluj" /> '.
                '<input class="btn btn-sm btn-danger" type="submit" name="yes" value="Usuń" /> </div>',
                'modal-lg',false,false,false,false,false,'POST','/lab/delete_type/'.$params[0].'/'.$params[1]);
        }
        if(isset($_POST['yes']))
        {
            $Model->deleteType($params[0],$params[1]);
        }
        $this->set('standard',$params[0]);
        $this->setTitle('Usuwanie typu');
    }

    public function manage_categories($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        if(!empty($_POST))
        {
            $Model->newCategorie($params[0],$_POST);
        }

        $this->set('standard_info',$Model->getStandards($params[0]));
        $this->set('list',$Model->getCategories($params[0]));
        $this->setTitle('Zarządzanie kategoriami');
    }

    public function delete_category($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        if(empty($_POST))
        {
            $standard = $Model->getStandards($params[0]);
            $category = $Model->getCategories($params[0],$params[1]);
            $this->setPromptWindow('confirmation',
                'Czy napewno usunąć kategorię natężenia ruchu?',
                'Czy napewno chcesz usunąć typ <b>'.$category['categorie'].'</b> ze standardu <b>'.$standard['name'].'</b>?'.
                '<div class="text-right"><input class="btn btn-sm btn-default" type="submit" name="no" value="Anuluj" /> '.
                '<input class="btn btn-sm btn-danger" type="submit" name="yes" value="Usuń" /> </div>',
                'modal-lg',false,false,false,false,false,'POST','/lab/delete_category/'.$params[0].'/'.$params[1]);
        }
        if(isset($_POST['yes']))
        {
            $Model->deleteCategory($params[0],$params[1]);
        }
        $this->set('standard',$params[0]);
        $this->setTitle('Usuwanie kategorii');
    }

    public function manage_descriptions($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        if(!empty($_POST))
        {
            $Model->newDescription($params[0],$_POST);
        }

        $this->set('standard_info',$Model->getStandards($params[0]));
        $this->set('list',$Model->getDescriptions($params[0]));
        $this->setTitle('Zarządzanie opisami');
    }

    public function delete_description($params) {

        $Model = $this->loadModel();

        if(!$Model->getStandards($params[0]))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        if(empty($_POST))
        {
            $standard = $Model->getStandards($params[0]);
            $description = $Model->getDescriptions($params[0],$params[1]);
            $this->setPromptWindow('confirmation',
                'Czy napewno usunąć kategorię natężenia ruchu?',
                'Czy napewno chcesz usunąć opis <b>'.$description['description'].'</b> ze standardu <b>'.$standard['name'].'</b>?'.
                '<div class="text-right"><input class="btn btn-sm btn-default" type="submit" name="no" value="Anuluj" /> '.
                '<input class="btn btn-sm btn-danger" type="submit" name="yes" value="Usuń" /> </div>',
                'modal-lg',false,false,false,false,false,'POST','/lab/delete_description/'.$params[0].'/'.$params[1]);
        }
        if(isset($_POST['yes']))
        {
            $Model->deleteDescription($params[0],$params[1]);
        }
        $this->set('standard',$params[0]);
        $this->setTitle('Usuwanie opisów');
    }

    /**
     * Rejestracja krzywych granicznych dla mixów typów i kategorii
     * @param $params
     */
    public function standard_mixes($params) {

        $type      = $params[0];
        $categorie = $params[1];

        $Model = $this->loadModel();

        if(!$Model->getTypes(null, $type) && !$Model->getCategories(null, $categorie))
        {
            Permissions::forwarding('/lab/standard_list/');
        }

        $borders = $Model->getBorders($type,$categorie);

        if(!empty($_POST))
        {
            $Model->insertBorders($type, $categorie, $_POST);
        }

        $this->set('borders',$borders);
        $this->set('type',$Model->getTypes(null, $type));
        $this->set('categorie',$Model->getCategories(null, $categorie));
        $this->setTitle('Określanie krzywych granicznych mieszanek');
    }

    public function settings() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->settingsSetTestsPerDay($_POST);
        }

        $this->set('settings',$Model->settingsGetTestsPerDay());
        $this->setTitle('Ustawienia laboratorium');
    }

    /** end of standard part */

    /**
     * Lista wszystkich badań
     */
    public function examinations() {

        $Model = $this->loadModel();

        $this->set('list',$Model->getExaminations(null, true));
        $this->set('model',$Model);
        $this->setTitle('Lista badań');
    }

    /**
     * Lista archiwum badań
     * @param $params
     */
    public function examinations_archive($params) {

        $year = $params[0];
        $month = $params[1];

        $Model = $this->loadModel();

        $this->set('list',$Model->getExaminationsInDate($params[0],$params[1], null, true));
        $this->set('model',$Model);
        $this->set('year', $year);
        $this->set('month', $month);
        $this->setTitle('Archiwum badań');
    }

    /**
     * Zlecanie badania
     * @param $params
     */
    public function new_examination($params) {

        $Model = $this->loadModel();
        $CRM_model = $this->loadModel('crm_model');

        if(isset($_POST['client']))
        {
            $Model->saveExaminationOrder($_POST);
        }

        $this->set('clients',$CRM_model->getClients(null, 1));
        $this->set('examination_types',$Model->getExaminationTypes(null, null, 1));
        $this->setTitle('Zlecanie badania');
    }

    /**
     * Lista typów badań
     */
    public function examination_types() {

        $Model = $this->loadModel();

        $this->set('list',$Model->getExaminationTypes(null,null,true));
        $this->setTitle('Lista aktywnych typów badań');
    }

    /**
     * Widok szczegółowy typu badań
     * @param $params
     */
    public function examination_type($params) {

        $Model = $this->loadModel();

        if(!$Model->getExaminationTypes(null,$params[0],true))
        {
            Permissions::forwarding('/lab/examination_types/');
        }

        $this->set('info',$Model->getExaminationTypes(null,$params[0],true));
        $this->set('curve',$Model->getCurve($params[0]));
        $this->set('mixtures',$Model->searchTypeExaminations($Model->getExaminations(),$params[0]));
        $this->setPromptWindow('delete', 'Archiwizowanie typu badań', 'Czy napewno chcesz zarchiwizować wybrany typ badań?<br /><br />Zarchiwizowany typ nie będzie mógł być wykorzystywany podczas rejestracji nowych badań!',
                                '', true, true, true, 'danger', 'default', 'post', '/lab/delete_examination_type/' . $params[0]);
        $this->setPromptWindow('delete_curve', 'Usuwanie krzywej uziarnienia', 'Czy napewno chcesz usunąć krzywą uziarnienia?<br /><br />Konieczne będzie zarejestrowanie nowej krzywej uziarnienia mieszanki w celu wykonywania badań próbek!',
            '', true, true, true, 'danger', 'default', 'post', '/lab/delete_curve/' . $params[0]);
        $this->setTitle('Szczegóły typu badań');
    }

    public function examination($params) {

        $Model = $this->loadModel();
        $CRM_Model = $this->loadModel('crm_model');

        if(!$Model->getExaminations($params[0]))
        {
            Permissions::forwarding('/lab/examinations/');
        }

        if(!empty($_POST))
        {
            $Model->confirmSample($params[0]);
        }

        $examination = $Model->getExaminations($params[0]);
        $this->set('examination',$examination);
        $this->set('client',$CRM_Model->getClients($examination['_client']));
        $this->set('contact',$CRM_Model->getContacts($examination['_client'],$examination['_client_contact']));
        $this->set('building',$CRM_Model->getBuildings($examination['_client'],$examination['_client_building']));
        $this->set('examination_type',$Model->getExaminationTypes(null, $examination['_examination_type']));
        $this->setPromptWindow('confirm_sample', 'Potwierdzenie dostarczenia próbki', 'Czy napewno chcesz potwierdzić dostarczenie próbki? <input type="hidden" name="confirm" value="yes" />',
            '', true, true, true, 'success', 'default', 'post', '/lab/examination/' . $params[0]);
        $this->setPromptWindow('delete',
            'Usuwanie zlecenia badania?',
            'Czy napewno chcesz usunąć zlecenie badania?<br /><br />Operacji tej nie można cofnąć!'.
            '<input type="hidden" name="confirm" value="yes" /> ',
            '',true,true,true,'danger','default','POST','/lab/delete_examination_order/'.$params[0]);
        $this->setTitle('Zlecone badanie');
    }

    public function delete_examination_order($params) {

        if(!empty($_POST))
        {
            $Model = $this->loadModel();
            $Model->deleteExaminationOrder($params[0]);
        }
        $this->setTitle('Usuwanie zlecenia badania');
    }

    public function examination_results($params) {

        $Model = $this->loadModel();
        $CRM_Model = $this->loadModel('crm_model');

        $examination = $Model->getExaminations($params[0]);

        if(!$examination)
        {
            Permissions::forwarding('/lab/examinations/');
        }

        $this->set('examination',$examination);
        $this->set('client',$CRM_Model->getClients($examination['_client']));
        $this->set('contact',$CRM_Model->getContacts($examination['_client'],$examination['_client_contact']));
        $this->set('building',$CRM_Model->getBuildings($examination['_client'],$examination['_client_building']));
        $this->set('examination_type',$Model->getExaminationTypes(null, $examination['_examination_type']));
        $this->set('examination_result',$Model->getExaminationResults($params[0]));
        $this->set('deviations',$Model->getDeviations($examination['standard']));
        $this->set('curve',$Model->getCurve($examination['_examination_type']));
        $this->set('sieves_set', $this->sieves_set);
        $this->set('certificate', $Model->getCertificates($params[0]));

        $this->setPromptWindow('certificate', 'Generowanie świadectwa wykonania badania próbki masy',
            '<div class="form-inline">
                <label>Osoba wystawiająca świadectwo: </label><br />
                <input type="text" class="form-control" name="creator" value="'.$_SESSION['user'].'" /><br />
                <label>Data wystawienia świadectwa: </label><br />
                <input type="datetime-local" class="form-control" name="datetime" value="'.$examination['status_changed_date'].'T'.substr($examination['status_changed_time'],0,5).'" /><br /><br />
                <a class="help-block">Uwaga: Świadectwo zostanie wygenerowane w postaci pliku pdf.</a>
             </div>',
            '', true, true, true, 'success', 'default', 'post', '/lab/new_certyficate/' . $params[0]);

        $this->setTitle('Wyniki badania');
    }

    /**
     * Archiwizowanie typów badań
     * @param $params
     */
    public function delete_examination_type($params) {

        $Model= $this->loadModel();
        $Model->delete_examination_type($params[0]);
        $this->setTitle('Usuwanie typu badania');
    }

    /**
     * Rejestracja wyników badania próbki
     * @param $params
     */
    public function run_examination($params) {

        $Model= $this->loadModel();

        $examination = $Model->getExaminations($params[0]);
        $examination_type = $Model->getExaminationTypes(null,$examination['_examination_type'],true);

        if(!$examination)
        {
            Permissions::forwarding('/lab/examinations/');
        }

        if(!empty($_POST))
        {
            $Model->saveExamination($params[0],$_POST);
        }

        #pobranie zestawu sit (wyodrebniam z krzywych granicznych
        $this->set('sieves',$Model->getBorders($examination_type['type'],$examination_type['categorie']));
        #lista wszystkich sit
        $this->set('sieves_set',$this->sieves_set);

        $this->set('examination',$examination);
        $this->set('info',$examination_type);

        $this->setTitle('Rejestrowanie wyników badania');
    }

    /** lista świadectw */
    public function certificate_list() {

        $Model = $this->loadModel();

        $this->set('list',$Model->getCertificates());
        $this->set('model',$Model);
        $this->setPromptWindow('pdf', 'Podgląd świadectwa',
            '<iframe id="frame" frameborder="0" style="width: 100%; height: 600px;"  src="'.PATH.'/lab/show_certificate/"></iframe>','modal-lg', false, true, true, null, null, null, null);

        $this->setTitle('Lista świadectw');
    }

    public function show_certificate($params) {

        if(!empty($params))
        {
            $Model=$this->loadModel();
            $Model->showCertificate($params[0], $this->sieves_set);
        }
    }

    /** Rejestracja certyfikatu
     * @param $params
     */
    public function new_certyficate($params) {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $temp = explode("T",$_POST['datetime']);
            $_POST['date'] = $temp[0];
            $_POST['time'] = $temp[1].":00";
            $this->set('examinations',$Model->saveCertyficate($params[0],$_POST));
        }

        $this->setTitle('Rejestracja certyfikatu');
    }

    /**
     * Archiwizowanie krzywych uziarnienia
     * @param $params
     */
    public function delete_curve($params) {

        $Model= $this->loadModel();

        if(!$Model->getExaminationTypes(null,$params[0],true))
        {
            Permissions::forwarding('/lab/examination_types/');
        }

        $Model->delete_curve($params[0]);
        $this->setTitle('Usuwanie krzywej uziarnienia');
    }

    /**
     * Widok miesięczny kalendarza
     * @param $params
     */
    public function schedule_month($params) {

        $year = $params[0];
        $month = $params[1];

        $Model = $this->loadModel();

        $this->set('examination_terms',$Model->getDatesFromArray($Model->getExaminationsInDate($params[0],$params[1]),'examination_date'));
        $this->set('examination_dates',$Model->getDatesFromArray($Model->getExaminationsInDate($params[0],$params[1], null, true),'status_changed_date'));
        $this->set('examination_dates_year',$Model->getDatesFromArray($Model->getExaminationsInDate($params[0],null, null, true),'status_changed_date'));

        $this->set('year', $year);
        $this->set('month', $month);
        $this->setTitle('Widok miesięczny harmonogramu');
    }

    /**
     * Widok dnia kalendarza
     * @param $params
     */
    public function schedule_day($params) {

        $year  = $params[0];
        $month = $params[1];
        $day   = $params[2];

        $Model = $this->loadModel();

        $this->set('examination_terms',$Model->getExaminationsInDate($params[0],$params[1],$params[2]));
        $this->set('examination_dates',$Model->getExaminationsInDate($params[0],$params[1], $params[2], true));

        $this->set('year', $year);
        $this->set('month', $month);
        $this->set('day', $day);
        $this->set('model',$Model);

        $this->setTitle('Harmonogram badań - '.$year.'-'.$month.'-'.$day);
    }

    /**
     * Rejestrowanie krzywej uziarnienia typu badań
     * @param $params
     */
    public function register_curve($params) {

        $Model = $this->loadModel();

        $examination_type = $Model->getExaminationTypes(null,$params[0],true);

        if(!$examination_type)
        {
            Permissions::forwarding('/lab/examination_types/');
        }

        if(!empty($_POST))
        {
            $Model->registerCurve($params[0],$_POST);
        }

        #pobranie zestawu sit (wyodrebniam z krzywych granicznych
        $this->set('sieves',$Model->getBorders($examination_type['type'],$examination_type['categorie']));
        #lista wszystkich sit
        $this->set('sieves_set',$this->sieves_set);

        $this->set('info',$examination_type);
        $this->setTitle('Rejestracja krzywej uziarnienia');
    }

    /**
     * Nowy typ badań
     */
    public function new_type() {

        $Model = $this->loadModel();

        if(!empty($_POST))
        {
            $Model->newExaminationType($_POST);
        }

        $this->set('standards',$Model->getStandards(null, true));
        $this->setTitle('Nowy typ badań');
    }


}