<?php

class crm_model extends model {

    /**
     * @param null $id
     * @param int $active - 1 aktywni, 0 niekatywni
     * @return array|bool|null
     */
	public function getClients($id = null, $active = null) {

        /** pobierz wszystkie */
        if(is_null($id))
        {
            if(!is_null($active))
            {
                $list = $this->getData("SELECT * FROM crm_clients_list WHERE _active = '$active' ORDER BY `name` ASC", false);
            }
            else
            {
                $list = $this->getData("SELECT * FROM crm_clients_list ORDER BY `name` ASC", false);
            }
        }
        else
        {
            if(is_null($active))
            {
                $list = $this->getData("SELECT * FROM crm_clients_list WHERE id = '$id'", true);
            }
            else
            {
                $list = $this->getData("SELECT * FROM crm_clients_list WHERE id = '$id' AND _active = '$active'", true);
            }
        }

        return $list;
    }

    public function findClients($string, $active = null) {

        /** pobierz wszystkie */
        if(!is_null($string))
        {
            if(!is_null($active))
            {
                $list = $this->getData("SELECT * FROM crm_clients_list WHERE (`name` LIKE '%$string%' OR nip LIKE '%$string%') AND _active = '$active' ORDER BY `name` ASC", false);
            }
            else
            {
                $list = $this->getData("SELECT * FROM crm_clients_list WHERE (`name` LIKE '%$string%' OR nip LIKE '%$string%') ORDER BY `name` ASC", false);
            }
        }
        else
        {
            return false;
        }

        return $list;
    }

    public function newClient($post) {

        $form = new form();

        if(!empty($post) && is_array($post))
        {
            $name                 = $form->prepareForQuery($post['name']);
            $name2                = $form->prepareForQuery($post['name2']);
            $str_type             = $form->prepareForQuery($post['str_type']);
            $street               = $form->prepareForQuery($post['street']);
            $number               = $form->prepareForQuery($post['number']);
            $post_code            = $form->prepareForQuery($post['post_code']);
            $city                 = $form->prepareForQuery($post['city']);
            $country              = ucfirst($form->prepareForQuery($post['country']));
            $nip                  = $form->prepareForQuery($post['nip']);
            $eunip                = $form->prepareForQuery($post['eunip']);
            $activity_description = $form->prepareForQuery($post['activity_description']);

            if(!$form->checkExpression($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\'\"]+$/'))
            {
                $form->setError('name','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($name2,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\"]+$/'))
            {
                $form->setError('name2','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($street,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\"]+$/'))
            {
                $form->setError('address','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($post_code, '/^[0-9\-]+$/'))
            {
                $form->setError('address2','Niedozwolony znak. Dozwolone znaki : a-z0-9.');
            }

            if(!$form->checkAlphabetical($city))
            {
                $form->setError('address2','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkAlphabetical($country))
            {
                $form->setError('country','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if($nip!='')
            {
                if(!$form->checkNumerical($nip))
                {
                    $form->setError('nip','Niedozwolony znak. Dozwolone są tylko cyfry.');
                }
            }

            if($eunip!='')
            {
                if(!$form->checkNumerical($eunip))
                {
                    $form->setError('eunip','Niedozwolony znak. Dozwolone są tylko cyfry.');
                }
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery('INSERT INTO crm_clients_list (`name`, name2, str_type, street, number, post_code, city, country, nip, eunip, activity_description)
                                      VALUES ("'.$name.'","'.$name2.'","'.$str_type.'","'.$street.'","'.$number.'","'.$post_code.'","'.$city.'","'.$country.'","'.$nip.'","'.$eunip.'","'.$activity_description.'")'))
                {
                    $new_client_id = $this->pdo->lastInsertId();

                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Klient zarejestrowany !','success','/crm/client/'.$new_client_id);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji klienta ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji klienta, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function editClient($client, $post) {

        $form = new form();

        if(!empty($post) && is_array($post) && isset($client) && !empty($client))
        {
            $name                 = $form->prepareForQuery($post['name']);
            $name2                = $form->prepareForQuery($post['name2']);
            $str_type             = $form->prepareForQuery($post['str_type']);
            $street               = $form->prepareForQuery($post['street']);
            $number               = $form->prepareForQuery($post['number']);
            $post_code            = $form->prepareForQuery($post['post_code']);
            $city                 = $form->prepareForQuery($post['city']);
            $country              = ucfirst($form->prepareForQuery($post['country']));
            $nip                  = $form->prepareForQuery($post['nip']);
            $eunip                = $form->prepareForQuery($post['eunip']);
            $activity_description = $form->prepareForQuery($post['activity_description']);
            $status               = (int)$_POST['status'];

            if(!$form->checkExpression($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\'\"]+$/'))
            {
                $form->setError('name','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($name2,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\"]+$/'))
            {
                $form->setError('name2','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($street,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\"]+$/'))
            {
                $form->setError('address','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($post_code, '/^[0-9\-]+$/'))
            {
                $form->setError('address2','Niedozwolony znak. Dozwolone znaki : a-z0-9.');
            }

            if(!$form->checkAlphabetical($city))
            {
                $form->setError('address2','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkAlphabetical($country))
            {
                $form->setError('country','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if($nip!='')
            {
                if(!$form->checkNumerical($nip))
                {
                    $form->setError('nip','Niedozwolony znak. Dozwolone są tylko cyfry.');
                }
            }

            if($eunip!='')
            {
                if(!$form->checkNumerical($eunip))
                {
                    $form->setError('eunip','Niedozwolony znak. Dozwolone są tylko cyfry.');
                }
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("UPDATE crm_clients_list SET `name` = '$name', name2 = '$name2', str_type = '$str_type', street = '$street', number = '$number',
                                                                post_code = '$post_code', city = '$city', country = '$country', nip = '$nip', eunip = '$eunip',
                                                                activity_description = '$activity_description', _active = '$status' WHERE id = '$client'"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Klient został zaktualizowany!','success','/crm/client/'.$client);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas aktualizacji klienta ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas aktualizacji klienta, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function getContacts($client, $id = null, $active = null) {

        if(!is_numeric($client))
        {
            return false;
        }

        /** pobierz wszystkie */
        if(is_null($id))
        {
            if(!is_null($active))
            {
                $list = $this->getData("SELECT * FROM crm_client_contacts WHERE client_id = '$client' AND _active = '$active' ORDER BY description ASC", false);
            }
            else
            {
                $list = $this->getData("SELECT * FROM crm_client_contacts WHERE client_id = '$client' ORDER BY description ASC", false);
            }
        }
        else
        {
            if(is_null($active))
            {
                $list = $this->getData("SELECT * FROM crm_client_contacts WHERE client_id = '$client' AND id = '$id'", true);
            }
            else
            {
                $list = $this->getData("SELECT * FROM crm_client_contacts WHERE client_id = '$client' AND id = '$id' AND _active = '$active'", true);
            }
        }

        return $list;
    }

    public function getBuildings($client, $id = null, $active = null) {

        if(!is_numeric($client))
        {
            return false;
        }

        /** pobierz wszystkie */
        if(is_null($id))
        {
            if(!is_null($active))
            {
                $list = $this->getData("SELECT * FROM crm_client_buildings WHERE client_id = '$client' AND _active = '$active' ORDER BY `name` ASC", false);
            }
            else
            {
                $list = $this->getData("SELECT * FROM crm_client_buildings WHERE client_id = '$client' ORDER BY `name` ASC", false);
            }
        }
        else
        {
            if(is_null($active))
            {
                $list = $this->getData("SELECT * FROM crm_client_buildings WHERE client_id = '$client' AND id = '$id'", true);
            }
            else
            {
                $list = $this->getData("SELECT * FROM crm_client_buildings WHERE client_id = '$client' AND id = '$id' AND _active = '$active'", true);
            }
        }

        return $list;
    }

    public function newContact($client, $post) {

        $form = new form();

        if(!empty($post) && is_array($post) && isset($client) && !empty($client))
        {
            $description = $form->prepareForQuery($post['description']);
            $phone       = $form->prepareForQuery($post['phone']);
            $email       = $form->prepareForQuery($post['email']);
            $comments    = $form->prepareForQuery($post['comments']);

            if(!$form->checkExpression($description,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\'\"]+$/'))
            {
                $form->setError('description','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!empty($comments))
            {
                if(!$form->checkExpression($comments,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9()\.\-,\"]+$/'))
                {
                    $form->setError('comments','Niedozwolony znak. Dozwolone są tylko litery i cyfry.');
                }
            }

            if(!empty($phone))
            {
                if(!$form->checkExpression($phone, '/^[0-9\-]+$/'))
                {
                    $form->setError('phone','Niedozwolony znak. Dozwolone znaki : 0-9 oraz znak "-".');
                }
            }

            if(!empty($email))
            {
                if(!$form->checkEmail($email))
                {
                    $form->setError('email','Nieprawidłowy format adresu e-mail.');
                }
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO crm_client_contacts (client_id, description, phone, email, comments)
                                      VALUES ('$client','$description','$phone','$email','$comments')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Kontakt do klienta zarejestrowany !','success','/crm/client/'.$client);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji kontaktu ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji kontaktu, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function editContact($client, $contact, $post) {

        $form = new form();

        if(!empty($post) && is_array($post) && isset($client) && !empty($client) && isset($contact) && !empty($contact))
        {
            $description = $form->prepareForQuery($post['description']);
            $phone       = $form->prepareForQuery($post['phone']);
            $email       = $form->prepareForQuery($post['email']);
            $comments    = $form->prepareForQuery($post['comments']);

            if(!$form->checkExpression($description,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\'\"]+$/'))
            {
                $form->setError('description','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!empty($comments))
            {
                if(!$form->checkExpression($comments,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9()\.\-,\"]+$/'))
                {
                    $form->setError('comments','Niedozwolony znak. Dozwolone są tylko litery i cyfry.');
                }
            }

            if(!empty($phone))
            {
                if(!$form->checkExpression($phone, '/^[0-9\-]+$/'))
                {
                    $form->setError('phone','Niedozwolony znak. Dozwolone znaki : 0-9 oraz znak "-".');
                }
            }

            if(!empty($email))
            {
                if(!$form->checkEmail($email))
                {
                    $form->setError('email','Nieprawidłowy format adresu e-mail.');
                }
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("UPDATE crm_client_contacts SET description = '$description', phone = '$phone', email = '$email', comments = '$comments' WHERE id = '$contact'"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Kontakt do klienta został zaktualizowany !','success','/crm/client/'.$client);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas aktualizacji kontaktu ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji kontaktu, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function newBuilding($client, $post) {

        $form = new form();

        if(!empty($post) && is_array($post) && isset($client) && !empty($client))
        {
            $name      = $form->prepareForQuery($post['name']);
            $str_type  = $form->prepareForQuery($post['str_type']);
            $street    = $form->prepareForQuery($post['street']);
            $number    = $form->prepareForQuery($post['number']);
            $post_code = $form->prepareForQuery($post['post_code']);
            $city      = $form->prepareForQuery($post['city']);
            $comments  = $form->prepareForQuery($post['comments']);

            if(!$form->checkExpression($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\'\"]+$/'))
            {
                $form->setError('name','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($street,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\"]+$/'))
            {
                $form->setError('address','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($post_code, '/^[0-9\-]+$/'))
            {
                $form->setError('address2','Niedozwolony znak. Dozwolone znaki : a-z0-9.');
            }

            if(!$form->checkAlphabetical($city))
            {
                $form->setError('address2','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO crm_client_buildings (client_id, `name`, str_type, street, number, post_code, city, comments)
                                      VALUES ('$client','$name','$str_type','$street','$number','$post_code','$city','$comments')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Budowa została zarejestrowana !','success','/crm/client/'.$client);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji budowy ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji budowy, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function editBuilding($client, $building, $post) {

        $form = new form();

        if(!empty($post) && is_array($post) && isset($client) && !empty($client) && isset($building) && !empty($building))
        {
            $name      = $form->prepareForQuery($post['name']);
            $str_type  = $form->prepareForQuery($post['str_type']);
            $street    = $form->prepareForQuery($post['street']);
            $number    = $form->prepareForQuery($post['number']);
            $post_code = $form->prepareForQuery($post['post_code']);
            $city      = $form->prepareForQuery($post['city']);
            $comments  = $form->prepareForQuery($post['comments']);

            if(!$form->checkExpression($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\'\"]+$/'))
            {
                $form->setError('name','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($street,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.\-,\"]+$/'))
            {
                $form->setError('address','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($post_code, '/^[0-9\-]+$/'))
            {
                $form->setError('address2','Niedozwolony znak. Dozwolone znaki : a-z0-9.');
            }

            if(!$form->checkAlphabetical($city))
            {
                $form->setError('address2','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("UPDATE crm_client_buildings SET `name` = '$name', str_type = '$str_type', street = '$street',
                                          number = '$number', post_code = '$post_code', city = '$city', comments = '$comments' WHERE id = '$building'"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Budowa została zaktualizowana !','success','/crm/client/'.$client);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas aktualizacji budowy ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji budowy, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Usuwanie kontaktu wraz z wygenerowaniem odpowiedniego komunikatu
     * @param $client
     * @param $contact
     * @internal param $user
     */
    public function deleteContact($client, $contact) {

        if($this->getContacts($client,$contact) && isset($client) && is_numeric($client) && isset($contact) && !empty($contact))
        {
            if($this->runQuery("UPDATE crm_client_contacts SET _active = 0 WHERE id = '$contact'"))
            {
                view::setAlertPanel('Kontakt został poprawnie usunięty', 'success', '/crm/client/'.$client, '3');
            }
            else
            {
                view::setAlertPanel('Wystapił błąd podczas usuwania kontaktu!', 'danger', null, null);
            }
        }
        else
        {
            view::setAlertPanel('Wystapił błąd podczas usuwania kontaktu!', 'danger', null, null);
        }
    }

    /**
     * Usuwanie budowy wraz z wygenerowaniem odpowiedniego komunikatu
     * @param $client
     * @param $building
     * @internal param $contact
     * @internal param $user
     */
    public function deleteBuilding($client, $building) {

        if($this->getBuildings($client,$building) && isset($client) && is_numeric($client) && isset($building) && !empty($building))
        {
            if($this->runQuery("UPDATE crm_client_buildings SET _active = 0 WHERE id = '$building'"))
            {
                view::setAlertPanel('Budowa została poprawnie usunięta', 'success', '/crm/client/'.$client, '3');
            }
            else
            {
                view::setAlertPanel('Wystapił błąd podczas usuwania budowy!', 'danger', null, null);
            }
        }
        else
        {
            view::setAlertPanel('Wystapił błąd podczas usuwania budowy!', 'danger', null, null);
        }
    }

    public function searchClientExaminations($examinations, $client) {

        if(!empty($examinations) && is_array($examinations) && !empty($client) && is_numeric($client))
        {
            $_examinations = array();
            foreach($examinations as $examination)
            {
                if($examination['_client']==$client)
                {
                    $_examinations[] = $examination;
                }
            }

            return $_examinations;
        }

        return false;
    }
}