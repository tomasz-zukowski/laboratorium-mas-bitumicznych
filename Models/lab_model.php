<?php

class lab_model extends model {

    /**
     * Pobieranie standardów lub standardu
     * @param null $id
     * @param null $active
     * @return array|bool|null
     */
    public function getStandards($id = null, $active = null) {

        /** pobierz wszystkie */
        if(is_null($id))
        {
            if(!is_null($active))
            {
                $list = $this->getData("SELECT * FROM lab_standards WHERE _active = '$active' ORDER BY `year` DESC", false);
            }
            else
            {
                $list = $this->getData("SELECT * FROM lab_standards ORDER BY `year` DESC", false);
            }
        }
        else
        {
            if(!is_null($active))
            {
                $list = $this->getData("SELECT * FROM lab_standards WHERE id = '$id' AND _active = '$active'", true);
            }
            else
            {
                $list = $this->getData("SELECT * FROM lab_standards WHERE id = '$id'", true);
            }
        }

        return $list;
    }

    /**
     * Sprawdzanie czy istnieje standard o nazwie podanej w name
     * @param $name
     * @return bool
     */
    public function isStandard($name) {

        if($this->getData("SELECT id FROM lab_standards WHERE `name` = '$name'"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Rejestracja nowego standardu
     * @param $post
     * @return bool
     */
    public function newStandard($post) {

        $form = new form();

        if(!empty($post) && is_array($post))
        {
            $name     = $form->prepareForQuery($post['name']);
            $document = $form->prepareForQuery($post['document']);
            $year     = $form->prepareForQuery($post['year']);

            if(!$this->isStandard($name))
            {
                if(!$form->checkExpression($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\'\"]+$/'))
                {
                    $form->setError('name','Niedozwolony znak. Dozwolone są litery, cyfry oraz znaki -\,..');
                }
            }
            else
            {
                $form->setError('name','Standard o takie nazwie już istnieje!');
            }

            if(!$form->checkExpression($document,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\"]+$/'))
            {
                $form->setError('document','Niedozwolony znak. Dozwolone są litery, cyfry oraz znaki -\,..');
            }

            if(!$form->checkNumerical($year))
            {
                $form->setError('year','Dozwolony rok w formacie: YYYY.');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery('INSERT INTO lab_standards (`name`, `year`, document)
                                      VALUES ("'.$name.'","'.$year.'","'.$document.'")'))
                {
                    $new_standard_id = $this->pdo->lastInsertId();

                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Standard został zarejestrowany !','success','/lab/standard/'.$new_standard_id);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji standardu ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji standardu, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function editStandard($standard, $post) {

        $form = new form();

        if(!empty($post) && is_array($post) && is_numeric($standard) && $this->getStandards($standard))
        {
            $name     = $form->prepareForQuery($post['name']);
            $document = $form->prepareForQuery($post['document']);
            $year     = $form->prepareForQuery($post['year']);

            if(!$form->checkExpression($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\'\"]+$/'))
            {
                $form->setError('name','Niedozwolony znak. Dozwolone są litery, cyfry oraz znaki -\,..');
            }

            if(!$form->checkExpression($document,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\"]+$/'))
            {
                $form->setError('document','Niedozwolony znak. Dozwolone są litery, cyfry oraz znaki -\,..');
            }

            if(!$form->checkNumerical($year))
            {
                $form->setError('year','Dozwolony rok w formacie: YYYY.');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("UPDATE lab_standards SET `name` = '$name', `year` = '$year', document = '$document' WHERE id = '$standard'"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Standard został uaktualniony !','success','/lab/standard/'.$standard);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas aktualizacji standardu ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas aktualizacji standardu, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function archivizeStandard($id) {

        if(!empty($id) && is_numeric($id))
        {
            $this->runQuery("START TRANSACTION");
            if(is_array($this->getStandards($id)) && $this->runQuery("UPDATE lab_standards SET _active = 0 WHERE id = '$id'"))
            {
                $this->runQuery("COMMIT");
                view::setAlertPanel('Standard został poprawnie zarchiwizowany', 'success', '/lab/standard_list', 3);
            }
            else
            {
                $this->runQuery("ROLLBACK");
                view::setAlertPanel('Wystapił błąd podczas archiwizacji standardu!', 'danger', '/lab/standard_list/',3);
            }
        }
        else
        {
            view::setAlertPanel('Wystapił błąd podczas archiwizacji standardu!', 'danger', '/lab/standard_list/',3);
        }
    }

    /**
     * Pobieranie typów/typu nawierzchni ze standardu
     * @param null $standard
     * @param null $id
     * @return array|bool|null
     */
    public function getTypes($standard=null, $id=null) {

        if(!is_null($standard) && is_numeric($standard) && $this->getStandards($standard))
        {
            if(is_null($id))
            {
                return $this->getData("SELECT * FROM lab_standards_types WHERE standard = '$standard' ORDER BY type", false);
            }
            else
            {
                return $this->getData("SELECT * FROM lab_standards_types WHERE id = '$id' AND standard = '$standard'", true);
            }
        }
        else
        {
            if(is_null($id))
            {
                return $this->getData("SELECT * FROM lab_standards_types ORDER BY type", false);
            }
            else
            {
                return $this->getData("SELECT * FROM lab_standards_types WHERE id = '$id'", true);
            }
        }

        return false;
    }

    /**
     * Rejestracja nowego typu do standardu
     * @param $standard
     * @param $post
     * @return bool
     */
    public function newType($standard,$post) {

        $form = new form();

        if(!empty($standard) && is_numeric($standard) && $this->getStandards($standard) && !empty($post) && is_array($post))
        {
            $name     = $form->prepareForQuery(strtoupper($post['name']));

            if(!$form->checkExpression($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\"]+$/'))
            {
                $form->setError('name','Niedozwolony znak. Dozwolone są litery, cyfry oraz znaki -\,..');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO lab_standards_types (type, standard)
                                      VALUES ('$name','$standard')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Nowy typ został zarejestrowany !','success','/lab/manage_types/'.$standard);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji nowego typu ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji nowego typu, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
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
     * Usuwanie typu
     * @param $standard
     * @param $id
     */
    public function deleteType($standard, $id) {

        if(!empty($standard) && is_numeric($standard) && $this->getStandards($standard) && !empty($id) && $this->getTypes($standard,$id))
        {
            $this->runQuery("START TRANSACTION");
            if($this->runQuery("DELETE FROM lab_standards_types WHERE id = '$id'") && $this->runQuery("DELETE FROM lab_standards_borders WHERE _type = '$id'"))
            {
                $this->runQuery("COMMIT");
                view::setAlertPanel('Typ został usunięty!','success','/lab/manage_types/'.$standard, 3);
            }
            else
            {
                $this->runQuery("ROLLBACK");
                view::setAlertPanel('Wystąpił błąd podczas usuwanie typu!','danger',null, null);
            }
        }
        else
        {
            view::setAlertPanel('Nie znaleziono danych','danger','/lab/standard/'.$standard,3);
        }
    }

    /**
     * Pobieranie kategorii standardu
     * @param null $standard
     * @param null $id
     * @return array|bool|null
     */
    public function getCategories($standard=null, $id=null) {

        if(!is_null($standard) && is_numeric($standard) && $this->getStandards($standard))
        {
            if(is_null($id))
            {
                return $this->getData("SELECT * FROM lab_standards_categories WHERE standard = '$standard' ORDER BY categorie", false);
            }
            else
            {
                return $this->getData("SELECT * FROM lab_standards_categories WHERE id = '$id' AND standard = '$standard'", true);
            }
        }
        else
        {
            if(is_null($id))
            {
                return $this->getData("SELECT * FROM lab_standards_categories ORDER BY categorie", false);
            }
            else
            {
                return $this->getData("SELECT * FROM lab_standards_categories WHERE id = '$id'", true);
            }
        }

        return false;
    }

    /**
     * Rejestracja kategorii do standardu
     * @param $standard
     * @param $post
     * @return bool
     */
    public function newCategorie($standard,$post) {

        $form = new form();

        if(!empty($standard) && is_numeric($standard) && $this->getStandards($standard) && !empty($post) && is_array($post))
        {
            $categorie     = $form->prepareForQuery(strtoupper($post['categorie']));

            if(!$form->checkExpression($categorie,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\"]+$/'))
            {
                $form->setError('categorie','Niedozwolony znak. Dozwolone są litery, cyfry oraz znaki -\,..');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO lab_standards_categories (categorie, standard)
                                      VALUES ('$categorie','$standard')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Nowa kategoria ruchu została zarejestrowana !','success','/lab/manage_categories/'.$standard);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji nowej kategorii ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji nowej kategorii, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
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
     * Usuwanie kategorii
     * @param $standard
     * @param $id
     */
    public function deleteCategory($standard, $id) {

        if(!empty($standard) && is_numeric($standard) && $this->getStandards($standard) && !empty($id) && $this->getCategories($standard,$id))
        {
            $this->runQuery("START TRANSACTION");
            if($this->runQuery("DELETE FROM lab_standards_categories WHERE id = '$id'") && $this->runQuery("DELETE FROM lab_standards_borders WHERE _categorie = '$id'"))
            {
                $this->runQuery("COMMIT");
                view::setAlertPanel('Kategoria natężenia ruchu została usunięta!','success','/lab/manage_categories/'.$standard, 3);
            }
            else
            {
                $this->runQuery("ROLLBACK");
                view::setAlertPanel('Wystąpił błąd podczas usuwania kategorii!','danger',null, null);
            }
        }
        else
        {
            view::setAlertPanel('Nie znaleziono danych','danger','/lab/standard/'.$standard,3);
        }
    }

    /**
     * Pobieranie opisów
     * @param $standard
     * @param null $id
     * @return array|bool|null
     */
    public function getDescriptions($standard, $id=null) {

        if(!empty($standard) && is_numeric($standard) && $this->getStandards($standard))
        {
            if(is_null($id))
            {
                return $this->getData("SELECT * FROM lab_standards_descriptions WHERE standard = '$standard' ORDER BY description", false);
            }
            else
            {
                return $this->getData("SELECT * FROM lab_standards_descriptions WHERE id = '$id' AND standard = '$standard'", true);
            }
        }

        return false;
    }

    /**
     * Rejestracja opisu
     * @param $standard
     * @param $post
     * @return bool
     */
    public function newDescription($standard,$post) {

        $form = new form();

        if(!empty($standard) && is_numeric($standard) && $this->getStandards($standard) && !empty($post) && is_array($post))
        {
            $description     = $form->prepareForQuery(ucfirst($post['description']));

            if(!$form->checkExpression($description,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\"]+$/'))
            {
                $form->setError('description','Niedozwolony znak. Dozwolone są litery, cyfry oraz znaki -\,..');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO lab_standards_descriptions (description, standard)
                                      VALUES ('$description','$standard')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Nowy opis został zarejestrowany !','success','/lab/manage_descriptions/'.$standard);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji nowego opisu ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji nowego opisu, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
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
     * Usuwanie opisu
     * @param $standard
     * @param $id
     */
    public function deleteDescription($standard, $id) {

        if(!empty($standard) && is_numeric($standard) && $this->getStandards($standard) && !empty($id) && $this->getDescriptions($standard,$id))
        {
            if($this->runQuery("DELETE FROM lab_standards_descriptions WHERE id = '$id'"))
            {
                view::setAlertPanel('Opis został usunięty!','success','/lab/manage_descriptions/'.$standard, 3);
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas usuwania opisu!','danger',null, null);
            }
        }
        else
        {
            view::setAlertPanel('Nie znaleziono danych','danger','/lab/standard/'.$standard,3);
        }
    }

    public function setDeviations($standard, $post) {

        $form = new form();

        $_standard = $this->getStandards($standard);

        if(!empty($standard) && is_numeric($standard) && !empty($post) && is_array($post) && !empty($_standard))
        {
            $post = str_replace(",",".",$post);

            $S45l = 'NULL';
            $S45r = 'NULL';
            if(!empty($post['S45l']))
            {
                $S45l = $post['S45l'];
                if(!empty($post['S45r']))
                {
                    $S45r = $post['S45r'];
                }
                else
                {
                    $S45r = ($post['S45l']+100);
                }
            }
            $S31l = 'NULL';
            $S31r = 'NULL';
            if(!empty($post['S31l']))
            {
                $S31l = $post['S31l'];
                if(!empty($post['S31r']))
                {
                    $S31r = $post['S31r'];
                }
                else
                {
                    $S31r = ($post['S31l']+100);
                }
            }
            $S22l = 'NULL';
            $S22r = 'NULL';
            if(!empty($post['S22l']))
            {
                $S22l = $post['S22l'];
                if(!empty($post['S22r']))
                {
                    $S22r = $post['S22r'];
                }
                else
                {
                    $S22r = ($post['S22l']+100);
                }
            }
            $S16l = 'NULL';
            $S16r = 'NULL';
            if(!empty($post['S16l']))
            {
                $S16l = $post['S16l'];
                if(!empty($post['S16r']))
                {
                    $S16r = $post['S16r'];
                }
                else
                {
                    $S16r = ($post['S16l']+100);
                }
            }
            $S11l = 'NULL';
            $S11r = 'NULL';
            if(!empty($post['S11l']))
            {
                $S11l = $post['S11l'];
                if(!empty($post['S11r']))
                {
                    $S11r = $post['S11r'];
                }
                else
                {
                    $S11r = ($post['S11l']+100);
                }
            }
            $S8l = 'NULL';
            $S8r = 'NULL';
            if(!empty($post['S8l']))
            {
                $S8l = $post['S8l'];
                if(!empty($post['S8r']))
                {
                    $S8r = $post['S8r'];
                }
                else
                {
                    $S8r = ($post['S8l']+100);
                }
            }
            $S5l = 'NULL';
            $S5r = 'NULL';
            if(!empty($post['S5l']))
            {
                $S5l = $post['S5l'];
                if(!empty($post['S5r']))
                {
                    $S5r = $post['S5r'];
                }
                else
                {
                    $S5r = ($post['S5l']+100);
                }
            }
            $S4l = 'NULL';
            $S4r = 'NULL';
            if(!empty($post['S4l']))
            {
                $S4l = $post['S4l'];
                if(!empty($post['S4r']))
                {
                    $S4r = $post['S4r'];
                }
                else
                {
                    $S4r = ($post['S4l']+100);
                }
            }
            $S2l = 'NULL';
            $S2r = 'NULL';
            if(!empty($post['S2l']))
            {
                $S2l = $post['S2l'];
                if(!empty($post['S2r']))
                {
                    $S2r = $post['S2r'];
                }
                else
                {
                    $S2r = ($post['S2l']+100);
                }
            }
            $S125l = 'NULL';
            $S125r = 'NULL';
            if(!empty($post['S125l']))
            {
                $S125l = $post['S125l'];
                if(!empty($post['S125r']))
                {
                    $S125r = $post['S125r'];
                }
                else
                {
                    $S125r = ($post['S125l']+100);
                }
            }
            $S063l = 'NULL';
            $S063r = 'NULL';
            if(!empty($post['S063l']))
            {
                $S063l = $post['S063l'];
                if(!empty($post['S063r']))
                {
                    $S063r = $post['S063r'];
                }
                else
                {
                    $S063r = ($post['S063l']+100);
                }
            }

            $bituml = 'NULL';
            $bitumr = 'NULL';
            if(!empty($post['bituml']))
            {
                $bituml = $post['bituml'];
                if(!empty($post['bitumr']))
                {
                    $bitumr = $post['bitumr'];
                }
                else
                {
                    $bitumr = ($post['bituml']);
                }
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                $this->runQuery("DELETE FROM lab_standards_deviations WHERE _standard = '$standard'");

                if($this->runQuery("INSERT INTO lab_standards_deviations (_standard, S063l, S063r, S125l, S125r, S2l, S2r, S4l, S4r, S5l, S5r, S8l, S8r, S11l, S11r, S16l, S16r, S22l, S22r, S31l, S31r, S45l, S45r, bituml, bitumr)
                                      VALUES ($standard,$S063l,$S063r,$S125l,$S125r,$S2l,$S2r,$S4l,$S4r,$S5l,$S5r,$S8l,$S8r,$S11l,$S11r,$S16l,$S16r,$S22l,$S22r,$S31l,$S31r,$S45l,$S45r,$bituml,$bitumr)"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Wartości zapisane !','success','/lab/standard/'.$standard,3);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas zapisywania dopuszczalnych odchyłek ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas zapisywania dopuszczalnych odchyłek, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function getDeviations($standard) {

        return $this->getData("SELECT * FROM lab_standards_deviations WHERE _standard = '$standard' LIMIT 1", true);
    }

    /**
     * Rejestrowanie krzywych granicznych mieszanek typów i kategorii
     * @param $type
     * @param $categorie
     * @param $post
     * @return bool
     */
    public function insertBorders($type, $categorie, $post) {

        $form = new form();

        $_type = $this->getTypes(null,$type);

        if(!empty($type) && !empty($categorie) && is_numeric($type) && is_numeric($categorie) && !empty($post) && is_array($post))
        {
            $post = str_replace(",",".",$post);

            $S45l = 'NULL';
            $S45r = 'NULL';
            if(!empty($post['S45l']))
            {
                $S45l = $post['S45l'];
                if(!empty($post['S45r']))
                {
                    $S45r = $post['S45r'];
                }
                else
                {
                    $S45r = ($post['S45l']+100);
                }
            }
            $S31l = 'NULL';
            $S31r = 'NULL';
            if(!empty($post['S31l']))
            {
                $S31l = $post['S31l'];
                if(!empty($post['S31r']))
                {
                    $S31r = $post['S31r'];
                }
                else
                {
                    $S31r = ($post['S31l']+100);
                }
            }
            $S22l = 'NULL';
            $S22r = 'NULL';
            if(!empty($post['S22l']))
            {
                $S22l = $post['S22l'];
                if(!empty($post['S22r']))
                {
                    $S22r = $post['S22r'];
                }
                else
                {
                    $S22r = ($post['S22l']+100);
                }
            }
            $S16l = 'NULL';
            $S16r = 'NULL';
            if(!empty($post['S16l']))
            {
                $S16l = $post['S16l'];
                if(!empty($post['S16r']))
                {
                    $S16r = $post['S16r'];
                }
                else
                {
                    $S16r = ($post['S16l']+100);
                }
            }
            $S11l = 'NULL';
            $S11r = 'NULL';
            if(!empty($post['S11l']))
            {
                $S11l = $post['S11l'];
                if(!empty($post['S11r']))
                {
                    $S11r = $post['S11r'];
                }
                else
                {
                    $S11r = ($post['S11l']+100);
                }
            }
            $S8l = 'NULL';
            $S8r = 'NULL';
            if(!empty($post['S8l']))
            {
                $S8l = $post['S8l'];
                if(!empty($post['S8r']))
                {
                    $S8r = $post['S8r'];
                }
                else
                {
                    $S8r = ($post['S8l']+100);
                }
            }
            $S5l = 'NULL';
            $S5r = 'NULL';
            if(!empty($post['S5l']))
            {
                $S5l = $post['S5l'];
                if(!empty($post['S5r']))
                {
                    $S5r = $post['S5r'];
                }
                else
                {
                    $S5r = ($post['S5l']+100);
                }
            }
            $S4l = 'NULL';
            $S4r = 'NULL';
            if(!empty($post['S4l']))
            {
                $S4l = $post['S4l'];
                if(!empty($post['S4r']))
                {
                    $S4r = $post['S4r'];
                }
                else
                {
                    $S4r = ($post['S4l']+100);
                }
            }
            $S2l = 'NULL';
            $S2r = 'NULL';
            if(!empty($post['S2l']))
            {
                $S2l = $post['S2l'];
                if(!empty($post['S2r']))
                {
                    $S2r = $post['S2r'];
                }
                else
                {
                    $S2r = ($post['S2l']+100);
                }
            }
            $S125l = 'NULL';
            $S125r = 'NULL';
            if(!empty($post['S125l']))
            {
                $S125l = $post['S125l'];
                if(!empty($post['S125r']))
                {
                    $S125r = $post['S125r'];
                }
                else
                {
                    $S125r = ($post['S125l']+100);
                }
            }
            $S063l = 'NULL';
            $S063r = 'NULL';
            if(!empty($post['S063l']))
            {
                $S063l = $post['S063l'];
                if(!empty($post['S063r']))
                {
                    $S063r = $post['S063r'];
                }
                else
                {
                    $S063r = ($post['S063l']+100);
                }
            }

            $bituml = 'NULL';
            $bitumr = 'NULL';
            if(!empty($post['bituml']))
            {
                $bituml = $post['bituml'];
                if(!empty($post['bitumr']))
                {
                    $bitumr = $post['bitumr'];
                }
                else
                {
                    $bitumr = ($post['bituml']);
                }
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                $this->runQuery("DELETE FROM lab_standards_borders WHERE _type = '$type' AND _categorie = '$categorie'");

                if($this->runQuery("INSERT INTO lab_standards_borders (_categorie, _type, S063l, S063r, S125l, S125r, S2l, S2r, S4l, S4r, S5l, S5r, S8l, S8r, S11l, S11r, S16l, S16r, S22l, S22r, S31l, S31r, S45l, S45r, bituml, bitumr)
                                      VALUES ($categorie,$type,$S063l,$S063r,$S125l,$S125r,$S2l,$S2r,$S4l,$S4r,$S5l,$S5r,$S8l,$S8r,$S11l,$S11r,$S16l,$S16r,$S22l,$S22r,$S31l,$S31r,$S45l,$S45r,$bituml,$bitumr)"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Wartości zapisane !','success','/lab/standard/'.$_type['standard'],3);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas zapisywania wartości granicznych ! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas zapisywania wartości granicznych, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
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
     * Pobieranie krzywych granicznych dla mieszanek typów i kategorii
     * @param $type
     * @param $categorie
     * @return array|bool|null
     */
    public function getBorders($type, $categorie) {

        if(!empty($type) && !empty($categorie) && is_numeric($type) && is_numeric($categorie))
        {
            return $this->getData("SELECT * FROM lab_standards_borders WHERE _type = '$type' AND _categorie = '$categorie'", true);
        }

        return false;
    }

    /**
     * Pobranie ilości badań w jednym dniu - ustawienia laboratorium
     * @return array|bool|null
     */
    public function settingsGetTestsPerDay() {

        return $this->getData("SELECT * FROM lab_configuration LIMIT 1", true);
    }

    /**
     * Zapisanie ilości badań w jednym dniu - ustawienia laboratorium
     * @return array|bool|null
     */
    public function settingsSetTestsPerDay($post) {

        if(!empty($post) && is_array($post))
        {
            if(!$this->getData("SELECT * FROM lab_configuration LIMIT 1", true))
            {
                if($this->runQuery("INSERT INTO lab_configuration (tests_per_day) VALUES ('".$post['tests_per_day']."')"))
                {
                    view::setAlertPanel('Ustawienia zapisane !','success','/lab/settings/',3);
                }
                else
                {
                    view::setAlertPanel('Wystąpił błąd podczas zapisywania ustawień! Skontaktuj się z administratorem.','danger',null,null);
                }
            }
            else
            {
                if($this->runQuery("UPDATE lab_configuration SET tests_per_day = '".$post['tests_per_day']."'"))
                {
                    view::setAlertPanel('Ustawienia zapisane !','success','/lab/settings/',3);
                }
                else
                {
                    view::setAlertPanel('Wystąpił błąd podczas zapisywania ustawień! Skontaktuj się z administratorem.','danger',null,null);
                }
            }
        }
    }

    /** end of standard part */

    /**
     * Rejestracja nowego typu badań laboratoryjnych
     * @param $post
     * @return bool
     */
    public function newExaminationType($post) {

        if(!empty($post) && is_array($post))
        {
            $form = new form();

            $symbol = $form->prepareForQuery($_POST['symbol']);

            if(!$form->checkExpression($symbol,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\.\-,\'\/\\"]+$/'))
            {
                $form->setError('symbol','Niedozwolony znak, użyj liter, cyfr i znaków: -\'"\\"');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO lab_examination_types (symbol, standard, description, type, categorie, created)
                                      VALUES ('$symbol','".$post['standard']."','".$post['description']."','".$post['type']."','".$post['categorie']."','".date("Y-m-d")."')"))
                {
                    $new_standard_id = $this->pdo->lastInsertId();

                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Typ badań został zarejestrowany !','success','/lab/examination_types/');
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji typu badań! Skontaktuj się z administratorem.','danger','/lab/new_type/',3);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji typu badań, sprawdź jeszcze raz wprowadzone dane !','danger','/lab/new_type/', 3);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        return false;
    }

    /**
     * Pobieranie typów badań laboratoryjnych wg standardu, aktywnosci lub id
     * @param null $standard
     * @param null $id
     * @param null $active
     * @return array|bool|null
     */
    public function getExaminationTypes($standard = null, $id = null, $active = null) {

        $filtr_active = '';
        if(!is_null($active))
        {
            if($active==true)
            {
                $filtr_active = " AND lab_examination_types._active = '1'";
            }
            else
            {
                $filtr_active = " AND lab_examination_types._active = '0";
            }
        }

        $filtr_standard = '';
        if(!is_null($standard))
        {
            $filtr_standard = " AND lab_examination_types.standard = '$standard'";
        }

        if(is_null($id))
        {
            return $this->getData("SELECT lab_examination_types.*, lab_standards.name as 'standard_name', lab_standards_descriptions.description as 'standard_description', lab_standards_types.type as 'standard_type', lab_standards_categories.categorie as 'standard_categorie'
                                      FROM lab_examination_types, lab_standards, lab_standards_categories, lab_standards_descriptions, lab_standards_types
                                      WHERE lab_examination_types.standard = lab_standards.id
                                       AND lab_examination_types.categorie = lab_standards_categories.id
                                       AND lab_examination_types.type = lab_standards_types.id
                                       AND lab_examination_types.description = lab_standards_descriptions.id
                                      $filtr_active $filtr_standard", false);
        }
        else
        {
            return $this->getData("SELECT lab_examination_types.*, lab_standards.name as 'standard_name', lab_standards_descriptions.description as 'standard_description', lab_standards_types.type as 'standard_type', lab_standards_categories.categorie as 'standard_categorie'
                                      FROM lab_examination_types, lab_standards, lab_standards_categories, lab_standards_descriptions, lab_standards_types
                                      WHERE lab_examination_types.standard = lab_standards.id
                                       AND lab_examination_types.categorie = lab_standards_categories.id
                                       AND lab_examination_types.type = lab_standards_types.id
                                       AND lab_examination_types.description = lab_standards_descriptions.id
                                       AND lab_examination_types.id = '$id'
                                       $filtr_active $filtr_standard", true);
        }
    }

    /**
     * Archiwizowanie typu badań laboratoryjnych
     * @param $id
     */
    public function delete_examination_type($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            $this->runQuery("START TRANSACTION");
            if(is_array($this->getExaminationTypes(null, $id, 1)) && $this->runQuery("UPDATE lab_examination_types SET _active = 0 WHERE id = '$id'"))
            {
                $this->runQuery("COMMIT");
                view::setAlertPanel('Typ badań został poprawnie zarchiwizowany', 'success', '/lab/examination_types', '3');
            }
            else
            {
                $this->runQuery("ROLLBACK");
                view::setAlertPanel('Wystapił błąd podczas archiwizacji typu badań!', 'danger', null, null);
            }
        }
        else
        {
            view::setAlertPanel('Wystapił błąd podczas archiwizacji typu badań!', 'danger', null, null);
        }

    }

    public function registerCurve($examination_type, $post) {

        $form = new form();

        $type = $this->getExaminationTypes(null, $examination_type);

		$temp_curve = $this->getCurve($examination_type);
		
        if(!empty($examination_type) && is_numeric($examination_type) && !empty($post) && is_array($post) && !empty($type) && empty($temp_curve))
        {
            $post = str_replace(",",".",$post);

            $values = array();
            $S45 = 'NULL';
            if(!empty($post['S45']))
            {
                $S45 = $post['S45'];
            }
            $values['S45'] = $S45;

            $S31 = 'NULL';
            if(!empty($post['S31']))
            {
                $S31 = $post['S31'];
            }
            $values['S31'] = $S31;

            $S22 = 'NULL';
            if(!empty($post['S22']))
            {
                $S22 = $post['S22'];
            }
            $values['S22'] = $S22;

            $S16 = 'NULL';
            if(!empty($post['S16']))
            {
                $S16 = $post['S16'];
            }
            $values['S16'] = $S16;

            $S11 = 'NULL';
            if(!empty($post['S11']))
            {
                $S11 = $post['S11'];
            }
            $values['S11'] = $S11;

            $S8 = 'NULL';
            if(!empty($post['S8']))
            {
                $S8 = $post['S8'];
            }
            $values['S8'] = $S8;

            $S5 = 'NULL';
            if(!empty($post['S5']))
            {
                $S5 = $post['S5'];
            }
            $values['S5'] = $S5;

            $S4 = 'NULL';
            if(!empty($post['S4']))
            {
                $S4 = $post['S4'];
            }
            $values['S4'] = $S4;

            $S2 = 'NULL';
            if(!empty($post['S2']))
            {
                $S2 = $post['S2'];
            }
            $values['S2'] = $S2;

            $S125 = 'NULL';
            if(!empty($post['S125']))
            {
                $S125 = $post['S125'];
            }
            $values['S125'] = $S125;

            $S063 = 'NULL';
            if(!empty($post['S063']))
            {
                $S063 = $post['S063'];
            }
            $values['S063'] = $S063;

            $bitum = 'NULL';
            if(!empty($post['bitum']))
            {
                $bitum = $post['bitum'];
            }
            $values['bitum'] = $bitum;

            /**
             * Sprawdzenie czy krzywa uziarnienia miesci sie miedzy krzywymi granicznymi
             *
             */

            $borders = $this->getBorders($type['type'],$type['categorie']);

            foreach($values as $key=>$value)
            {
                if($value!='NULL')
                {
                    if($value<$borders[$key.'l'] || $value>$borders[$key.'r'])
                    {
                        $form->setError($key,'Nieprawidłowa wartość krzywej uziarnienia dla tego punktu. Wartość krzywej uziarnienia musi znajdować się pomiędzy '.$borders[$key.'l'].' a '.$borders[$key.'r'].'.');
                    }
                }
            }

            $date = $form->prepareForQuery($post['date']);

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                $this->runQuery("DELETE FROM lab_curves WHERE _examination_type = '$examination_type'");

                if($this->runQuery("INSERT INTO lab_curves (_examination_type, S063, S125, S2, S4, S5, S8, S11, S16, S22, S31, S45, bitum, register_date)
                                      VALUES ($examination_type,$S063,$S125,$S2,$S4,$S5,$S8,$S11,$S16,$S22,$S31,$S45,$bitum,'$date')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Krzywa uziarnienia została zapisana!','success','/lab/examination_type/'.$examination_type,3);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas zapisywania krzywej uziarnienia !','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas zapisywania krzywej uziarnienia, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function delete_curve($examination_type)
    {
        if(!empty($examination_type) && is_numeric($examination_type))
        {
            $this->runQuery("START TRANSACTION");
            if($this->runQuery("DELETE FROM lab_curves WHERE _examination_type = '$examination_type'"))
            {
                $this->runQuery("COMMIT");
                view::setAlertPanel('Krzywa uziarnienia została usunięta', 'success', '/lab/examination_type/'.$examination_type, '3');
            }
            else
            {
                $this->runQuery("ROLLBACK");
                view::setAlertPanel('Wystapił błąd podczas usuwania!', 'danger', null, null);
            }
        }
        else
        {
            view::setAlertPanel('Wystapił błąd podczas usuwania!', 'danger', null, null);
        }

    }

    /**
     * Pobranie krzywej uziarnienia
     * @param $examination_type
     * @return array|bool|null
     */
    public function getCurve($examination_type) {

        return $this->getData("SELECT * FROM lab_curves WHERE _examination_type = '$examination_type' LIMIT 1", true);

    }

    /**
     * Zapisywanie zlecenia na badanie + rejestracja próbki
     * @param $post
     * @return bool
     */
    public function saveExaminationOrder($post) {

        if(!empty($post) && is_array($post))
        {
            $form = new form();

            $client                 = $post['client'];
            $client_building        = $post['client_building'];
            $client_contact         = $post['client_contact'];
            $examination_date       = $form->prepareForQuery($post['date']);
            $examination_type       = $post['examination_type'];
            $sample_status          = $form->prepareForQuery($post['sample_status']);
            if($sample_status==1)
            {
                $user = $_SESSION['id'];
            }
            else
            {
                $user = null;
            }
            if(isset($post['collection_date']) && (isset($post['sample_method']) && $post['sample_method']=='0') || $sample_status==1)
            {
                $sample_collection_date = $form->prepareForQuery($post['collection_date']);
            }
            else
            {
                $sample_collection_date = null;
            }

            if(isset($post['sample_method']))
            {
                $sample_method = $post['sample_method'];
            }
            else
            {
                $sample_method = null;
            }

            if(isset($post['number_yes']) && $post['number_yes'] != '')
            {
                $sample_number = $form->prepareForQuery($post['number_yes']);
            }
            elseif(isset($post['number_no_collection']) && $post['number_no_collection'] != '')
            {
                $sample_number = $form->prepareForQuery($post['number_no_collection']);
            }
            elseif(isset($post['number_no_sending']) && $post['number_no_sending'] != '')
            {
                $sample_number = $form->prepareForQuery($post['number_no_sending']);
            }

            if(!$form->checkExpression($sample_number,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń0-9\/\.\-,\"]+$/'))
            {
                $form->setError('number','Niedozwolony znak. Dozwolone są litery, cyfry oraz znaki -\,..');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                /** zapisywanie probki */
                if(!$this->runQuery("INSERT INTO lab_examination_samples (number, `status`, method, collection_date, user)
                                      VALUES ('$sample_number','$sample_status','$sample_method','$sample_collection_date','$user')"))
                {
                    $error = true;
                }
                else
                {
                    $sample_id = $this->pdo->lastInsertId();
                }

                /** zapisywanie zlecenia badania */
                if(!$this->runQuery("INSERT INTO lab_examination_orders (_client, _client_building, _client_contact, examination_date, _examination_type, _sample, sample_status, `user`)
                                      VALUES ('$client','$client_building','$client_contact','$examination_date','$examination_type','$sample_id','$sample_status','".$_SESSION['id']."')"))
                {
                    $error = true;
                }

                if(!isset($error))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Zlecenia badania zostało zarejestrowane!','success','/lab/examinations/');
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas zlecania badania! Skontaktuj się z administratorem.','danger','/lab/new_examination');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas zlecania badania!','danger',null, null);
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
     * Pobieranie badań
     * @param null $id
     * @param null $active
     * @internal param int $mode 0 wszystkie, 1 id
     * @return array|bool|null
     */
    public function getExaminations($id = null, $active = null) {

        $filtr_active = '';
        if(!is_null($active))
        {
            if($active==true)
            {
                $filtr_active = " AND lab_examination_orders.status = '0'";
            }
            elseif($active==false)
            {
                $filtr_active = " AND lab_examination_orders.status = '1";
            }
            else
            {
                $filtr_active = '';
            }
        }

        if(!is_null($id))
        {
            return $this->getData("SELECT lab_examination_orders.*, lab_examination_samples.collection_date, lab_examination_samples.user, lab_examination_samples.number as 'sample_number', lab_examination_samples.status as 'sample_sample_status', lab_examination_samples.method as 'sample_method', lab_examination_types.symbol, lab_examination_types.standard
                                  FROM lab_examination_orders, lab_examination_samples, lab_examination_types
                                  WHERE lab_examination_orders._sample = lab_examination_samples.id
                                  AND lab_examination_orders._examination_type = lab_examination_types.id
                                  AND lab_examination_orders.id = '$id'
                                  $filtr_active", true);
        }
        else
        {
            return $this->getData("SELECT lab_examination_orders.*, lab_examination_samples.collection_date, lab_examination_samples.user, lab_examination_samples.number as 'sample_number', lab_examination_samples.status as 'sample_sample_status', lab_examination_samples.method as 'sample_method', lab_examination_types.symbol, lab_examination_types.standard
                                      FROM lab_examination_orders, lab_examination_samples, lab_examination_types
                                      WHERE lab_examination_orders._sample = lab_examination_samples.id
                                      AND lab_examination_orders._examination_type = lab_examination_types.id
                                      $filtr_active
                                      ORDER BY lab_examination_orders.examination_date ASC", false);
        }
    }

    public function confirmSample($sample) {

        if(!empty($sample) && is_numeric($sample))
        {
            if($examination = $this->getExaminations($sample))
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("UPDATE lab_examination_orders SET sample_status = '1' WHERE id = '".$examination['id']."'")
                    && $this->runQuery("UPDATE lab_examination_samples SET collection_date = '".date('Y-m-d')."', `user` = '".$_SESSION['id']."' WHERE id = '".$examination['_sample']."'"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Próbka została potwierdzona!','success','/lab/examination/'.$sample,3);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas potwierdzania próbki! Skontaktuj się z administratorem.','danger','/lab/examination/'.$sample,3);
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas potwierdzania próbki! Skontaktuj się z administratorem.','danger','/lab/examination/'.$sample,3);
                return false;
            }
        }
        else
        {
            view::setAlertPanel('Wystąpił błąd podczas potwierdzania próbki! Skontaktuj się z administratorem.','danger','/lab/examination/'.$sample,3);
            return false;
        }
    }

    public function searchTypeExaminations($examinations, $type) {

        if(!empty($examinations) && is_array($examinations) && !empty($type) && is_numeric($type))
        {
            $_examinations = array();
            foreach($examinations as $examination)
            {
                if($examination['_examination_type']==$type)
                {
                    $_examinations[] = $examination;
                }
            }

            return $_examinations;
        }

        return false;
    }

    public function deleteExaminationOrder($id) {

        if(!empty($id) && is_numeric($id) && $examination = $this->getExaminations($id))
        {
            $this->runQuery("START TRANSACTION");
            if($this->runQuery("DELETE FROM lab_examination_orders WHERE id = '$id'") && $this->runQuery("DELETE FROM lab_examination_samples WHERE id = '".$examination['_sample']."'"))
            {
                $this->runQuery("COMMIT");
                view::setAlertPanel('Badanie zostało usunięte!','success','/lab/examinations/', 3);
            }
            else
            {
                $this->runQuery("ROLLBACK");
                view::setAlertPanel('Wystąpił błąd podczas usuwania badania!','danger','/lab/examinations/', 3);
            }
        }
        else
        {
            view::setAlertPanel('Nie znaleziono danych','danger','/lab/examinations/',3);
        }
    }

    public function saveExamination($examination_order, $post) {

        $form = new form();

        $examination_order = $this->getExaminations($examination_order);
        $type = $this->getExaminationTypes(null,$examination_order['_examination_type']);

		$temp_curve = $this->getCurve($examination_order['_examination_type']);
		
        if(!empty($post) && is_array($post) && !empty($examination_order) && !empty($temp_curve))
        {
            $post = str_replace(",",".",$post);

            $values = array();
            $S45 = 'NULL';
            if(!empty($post['S45']))
            {
                $S45 = $post['S45'];
            }
            $values['S45'] = $S45;

            $S31 = 'NULL';
            if(!empty($post['S31']))
            {
                $S31 = $post['S31'];
            }
            $values['S31'] = $S31;

            $S22 = 'NULL';
            if(!empty($post['S22']))
            {
                $S22 = $post['S22'];
            }
            $values['S22'] = $S22;

            $S16 = 'NULL';
            if(!empty($post['S16']))
            {
                $S16 = $post['S16'];
            }
            $values['S16'] = $S16;

            $S11 = 'NULL';
            if(!empty($post['S11']))
            {
                $S11 = $post['S11'];
            }
            $values['S11'] = $S11;

            $S8 = 'NULL';
            if(!empty($post['S8']))
            {
                $S8 = $post['S8'];
            }
            $values['S8'] = $S8;

            $S5 = 'NULL';
            if(!empty($post['S5']))
            {
                $S5 = $post['S5'];
            }
            $values['S5'] = $S5;

            $S4 = 'NULL';
            if(!empty($post['S4']))
            {
                $S4 = $post['S4'];
            }
            $values['S4'] = $S4;

            $S2 = 'NULL';
            if(!empty($post['S2']))
            {
                $S2 = $post['S2'];
            }
            $values['S2'] = $S2;

            $S125 = 'NULL';
            if(!empty($post['S125']))
            {
                $S125 = $post['S125'];
            }
            $values['S125'] = $S125;

            $S063 = 'NULL';
            if(!empty($post['S063']))
            {
                $S063 = $post['S063'];
            }
            $values['S063'] = $S063;

            $bitum = 'NULL';
            if(!empty($post['bitum']))
            {
                $bitum = $post['bitum'];
            }
            $values['bitum'] = $bitum;

            /**
             * sprawdzenie czy wartosci mieszcza sie w granicach odchylki od krzywej
             */

            $deviations = $this->getDeviations($examination_order['standard']);
            $curve = $this->getCurve($examination_order['_examination_type']);
            $deviations_values = array();
            foreach($values as $key=>$value)
            {
                if($value!='NULL')
                {
                    $temp_value = $value-$curve[$key];
                    $deviations_values[$key] = $temp_value;
                    if($temp_value<$deviations[$key.'l'] || $temp_value>$deviations[$key.'r'])
                    {
                        $error = true;
                    }
                }
                else
                {
                    $deviations_values[$key] = '';
                }
            }


            if(isset($error))
            {
                $result      = 0;
                $result_text = 'Niezgodne';
            }
            else
            {
                $result      = 1;
                $result_text = 'Zgodne';
            }

            $date = $form->prepareForQuery($post['date']);

            if(isset($result))
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO lab_examination_results (_examination_order, `client`, _examination_type, S063, S125, S2, S4, S5, S8, S11, S16, S22, S31, S45, bitum, register_date, result)
                                      VALUES ('".$examination_order['id']."','".$examination_order['_client']."','".$examination_order['_examination_type']."',$S063,$S125,$S2,$S4,$S5,$S8,$S11,$S16,$S22,$S31,$S45,$bitum,'".$date."','".$result."')")
                    && $this->runQuery("UPDATE lab_examination_orders SET `status` = 1, status_changed_date = '".date("Y-m-d")."', status_changed_time = '".date("H:i:s")."' WHERE id = '".$examination_order['id']."'"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Badanie zostało zapisane. Wynik badania : '.$result_text.'!','info','/lab/examination/'.$examination_order['id'],3);
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas zapisywania badania ! Skontaktuj się z administratorem.','danger',null,null);
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas zapisywania krzywej uziarnienia, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
                view::set('form_errors',$form->getErrors());
                return false;
            }
        }
        else
        {
            view::setAlertPanel('Wystąpił błąd podczas zapisywania krzywej uziarnienia, sprawdź jeszcze raz wprowadzone dane !','danger',null, null);
            view::set('form_errors',$form->getErrors());
            return false;
        }
    }

    public function getExaminationResults($order) {

        if(!empty($order) && is_numeric($order))
        {
            return $this->getData("SELECT * FROM lab_examination_results WHERE _examination_order = '$order' LIMIT 1", true);
        }
        else
        {
            return false;
        }

    }

    /** kalendarz - start */

    /**
     * Pobieranie badan wg dat
     * @param null $year
     * @param null $month
     * @param null $day
     * @param bool $active
     * @return array|bool|null
     */
    public function getExaminationsInDate($year=null,$month=null,$day=null, $active = false) {

        if($active==true)
        {
            $active = 'status_changed_date';
        }
        else
        {
            $active = 'examination_date';
        }

        if(!is_null($day))
        {
            return $this->getData("SELECT lab_examination_orders.*, lab_examination_samples.collection_date, lab_examination_samples.user, lab_examination_samples.number as 'sample_number', lab_examination_samples.status as 'sample_sample_status', lab_examination_samples.method as 'sample_method', lab_examination_types.symbol, lab_examination_types.standard
                                      FROM lab_examination_orders, lab_examination_samples, lab_examination_types
                                      WHERE lab_examination_orders._sample = lab_examination_samples.id
                                      AND lab_examination_orders._examination_type = lab_examination_types.id
                                      AND $active = '".$year."-".$month."-".$day."'", false);
        }
        if(!is_null($month))
        {
            return $this->getData("SELECT lab_examination_orders.*, lab_examination_samples.collection_date, lab_examination_samples.user, lab_examination_samples.number as 'sample_number', lab_examination_samples.status as 'sample_sample_status', lab_examination_samples.method as 'sample_method', lab_examination_types.symbol, lab_examination_types.standard
                                      FROM lab_examination_orders, lab_examination_samples, lab_examination_types
                                      WHERE lab_examination_orders._sample = lab_examination_samples.id
                                      AND lab_examination_orders._examination_type = lab_examination_types.id
                                      AND $active LIKE '".$year."-".$month."%'", false);
        }
        if(!is_null($year))
        {
            return $this->getData("SELECT lab_examination_orders.*, lab_examination_samples.collection_date, lab_examination_samples.user, lab_examination_samples.number as 'sample_number', lab_examination_samples.status as 'sample_sample_status', lab_examination_samples.method as 'sample_method', lab_examination_types.symbol, lab_examination_types.standard
                                      FROM lab_examination_orders, lab_examination_samples, lab_examination_types
                                      WHERE lab_examination_orders._sample = lab_examination_samples.id
                                      AND lab_examination_orders._examination_type = lab_examination_types.id
                                      AND $active LIKE '".$year."%'", false);
        }
        else
        {
            return $this->getData("SELECT lab_examination_orders.*, lab_examination_samples.collection_date, lab_examination_samples.user, lab_examination_samples.number as 'sample_number', lab_examination_samples.status as 'sample_sample_status', lab_examination_samples.method as 'sample_method', lab_examination_types.symbol, lab_examination_types.standard
                                      FROM lab_examination_orders, lab_examination_samples, lab_examination_types
                                      WHERE lab_examination_orders._sample = lab_examination_samples.id
                                      AND lab_examination_orders._examination_type = lab_examination_types.id", false);
        }
    }

    public function getDatesFromArray($orders, $date_field) {

        $dates = array();

        if(!empty($orders))
        {
            for($i=0;$i<count($orders);$i++)
            {
                $dates[] = $orders[$i][$date_field];
            }
            $dates = array_unique($dates);

            return $dates;
        }

        return $dates;
    }

    /**
     * Pobieranie certyfikatów
     * @param null $id
     * @return array|bool|null
     */
    public function getCertificates($id = null) {

        if(!is_null($id))
        {
            return $this->getData("SELECT lab_examination_orders.*, lab_examination_samples.collection_date, lab_examination_samples.user, lab_examination_samples.number as 'sample_number', lab_examination_samples.status as 'sample_sample_status', lab_examination_samples.method as 'sample_method', lab_examination_types.symbol, lab_examination_types.standard, lab_certificate._date, lab_certificate._time, lab_certificate.creator
                                      FROM lab_examination_orders, lab_examination_samples, lab_examination_types, lab_certificate
                                      WHERE lab_examination_orders._sample = lab_examination_samples.id
                                      AND lab_examination_orders._examination_type = lab_examination_types.id
                                      AND lab_examination_orders.id = lab_certificate._examination
                                      AND lab_examination_orders.id = '$id'", true);
        }
        else
        {
            return $this->getData("SELECT lab_examination_orders.*, lab_examination_samples.collection_date, lab_examination_samples.user, lab_examination_samples.number as 'sample_number', lab_examination_samples.status as 'sample_sample_status', lab_examination_samples.method as 'sample_method', lab_examination_types.symbol, lab_examination_types.standard, lab_certificate._date, lab_certificate._time, lab_certificate.creator
                                      FROM lab_examination_orders, lab_examination_samples, lab_examination_types, lab_certificate
                                      WHERE lab_examination_orders._sample = lab_examination_samples.id
                                      AND lab_examination_orders._examination_type = lab_examination_types.id
                                      AND lab_examination_orders.id = lab_certificate._examination
                                      ORDER BY lab_certificate._date DESC", false);
        }
    }

    public function saveCertyficate($examination, $post) {

        $form = new form();

        if(!empty($post) && is_array($post) && $this->getExaminations($examination))
        {

            $creator = $form->prepareForQuery($post['creator']);
            $date    = $form->prepareForQuery($post['date']);
            $time    = $form->prepareForQuery($post['time']);


            if(!$form->checkAlphabetical($creator))
            {
                $form->setError('null','');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO lab_certificate (_examination, _date, _time, creator)
                                      VALUES ('$examination','$date','$time','$creator')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Certyfikat został zapisany !','success','/lab/certificate_list/');
                    return true;
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestracji certyfikatu ! Skontaktuj się z administratorem.','danger','/lab/certificate_list');
                    return false;
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji certyfikatu!','danger','certificate_list');
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function showCertificate($examination_id, $sieves_set) {

        if(is_numeric($examination_id))
        {
            require('Libs/mpdf/mpdf.php');

            $CRM_model          = $this->loadModel('crm_model');
            $certificate        = $this->getCertificates($examination_id);
            $examination_result = $this->getExaminationResults($examination_id);
            $examination_type   = $this->getExaminationTypes($certificate['standard'], $certificate['_examination_type']);
            $contact            = $CRM_model->getContacts($certificate['_client'], $certificate['_client_contact']);
            $building           = $CRM_model->getBuildings($certificate['_client'], $certificate['_client_building']);
            $client             = $CRM_model->getClients($certificate['_client']);
            $deviations         = $this->getDeviations($certificate['standard']);
            $curve              = array_reverse($this->getCurve($certificate['_examination_type']));

            $html = '<div style="width: 100%;">';
            $html .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 30px;">
                                    <h2>ŚWIADECTWO PRZEPROWADZENIA BADANIA MASY<br /><br />
                                    '.$examination_type['symbol'].' - '.$examination_type['standard_name'].'</h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;">
                                <p style="font-size: 15px;">'.$client['name2'].'</p>';
                        $html .= "<i style='font-size: 13px;'>".$client['str_type']." ".$client['street']." ".$client['number'].", ".$client['post_code']." ".$client['city']."</i><br /><br />";
                        $html .= "<p style='font-size: 15px;'>".$building['name']."</p>";
                        $html .= "<i style='font-size: 13px;'>".$building['str_type']." ".$building['street']." ".$building['number'].", ".$building['post_code']." ".$building['city']."</i><br /><br />";
                        $html .= '<p style="font-size: 15px;">'.$contact['description'].'</p>';
                        if(!empty($contact['phone']))
                        {
                            $html .= "<p style='margin-top: 0px; font-size: 13px;'>Tel. ".$contact['phone']."</p>";
                        }
                        if(!empty($contact['email']))
                        {
                            $html .= "<p style='margin-top: -10px; font-size: 13px;'>E-mail: <a>".$contact['email']."</a></p>";
                        }
                        $html .= '</td>';
                $html .= '<td></td>';
                $html .= '<td style="width: 40%; padding: 30px; font-size: 25px 0px; color: silver;">[Pieczątka firmy]</td>';
                $html .= '</tr>
                        </table>';

            $html .= '<table border="1" style="border-collapse: collapse; width: 100%; margin-bottom: 30px;">
                        <thead>
                            <tr>
                                <th style="width: 50%; padding: 10px;" colspan="2">Informacje o badaniu</th>
                                <th style="width: 50%; padding: 10px;" colspan="2">Informacje o próbce</th>
                            </tr>
                        </thead>';
            $html .= '<tr>
                            <td style="padding: 5px; width: 25%; font-size: 13px;">Termin badania</td>
                            <td style="padding: 5px; width: 25%; font-size: 13px;">'.$certificate['examination_date'].'</td>
                            <td style="padding: 5px; width: 25%; font-size: 13px;">Nazwa</td>
                            <td style="padding: 5px; width: 25%; font-size: 13px;">'.$certificate['sample_number'].'</td>
                        </tr>';
            $html .= '<tr>
                            <td style="padding: 5px; width: 25%; font-size: 13px;">Data wykonania badania</td>
                            <td style="padding: 5px; width: 25%; font-size: 13px;">'.$certificate['status_changed_date'].' '.$certificate['status_changed_time'].'</td>
                            <td style="padding: 5px; width: 25%; font-size: 13px;">Data dostarczenia</td>
                            <td style="padding: 5px; width: 25%; font-size: 13px;">'.$certificate['collection_date'].'</td>
                        </tr>';
            if($examination_result['result']==1)
            {
                $result = 'zgodny';
            }
            else
            {
                $result = 'niezgodny';
            }
            if($certificate['sample_method']==1)
            {
                $type = "<p>Wysyłka</p>";
            }
            else
            {
                $type = "<p>Odbiór (<i>".$certificate['collection_date']."</i>)</p>";
            }
            $html .= '<tr>
                            <td style="padding: 5px;width: 25%; font-size: 13px;">Wynik badania</td>
                            <td style="padding: 5px;font-size: 13px;"><u><b>'.$result.'</b></u></td>
                            <td style="padding: 5px;width: 25%; font-size: 13px;">Sposób dostarczenia</td>
                            <td style="padding: 5px;font-size: 13px;">'.$type.'</td>
                        </tr>';
            $html .= '</table>';

            $html .= '<table style="width: 100%; font-size: 12px; border-collapse: collapse;" border="1">
                        <thead>
                            <tr>
                                <th style="padding: 5px;">Przechodzi przez sito</th>
                                <th style="padding: 5px;">Krzywa uziarnienia</th>
                                <th style="padding: 5px;">Badanie laboratoryjne</th>
                                <th style="padding: 5px;">Dop. odchyłka</th>
                                <th style="padding: 5px;">Odchyłka</th>
                                <th style="padding: 5px;">Wynik badania</th>
                            </tr>
                        </thead>';


            $_curve             = array();
            foreach($curve as $key=>$value)
            {
                $mystring = $key;
                $findme   = 'S';
                if(strpos($mystring, $findme)!==false)
                {
                    $_curve[$key]=$value;
                }
            }

            foreach($_curve as $key=>$value)
            {
                if($_curve[$key]!='')
                {
                    $diff = $examination_result[$key]-$_curve[$key];
                    $html .= "<tr>";
                    $html .= "<td style='padding: 5px; text-align: right;'>".$sieves_set[$key]." [mm]</td>";
                    $html .= "<td style='padding: 5px;'>".$_curve[$key]."</td>";
                    $html .= "<td style='padding: 5px;'>".$examination_result[$key]."</td>";
                    $html .= "<td style='padding: 5px; text-align: center;'>".$deviations[$key.'l']."/+".$deviations[$key.'r']."</td>";
                    $html .= "<td style='padding: 5px;'>".number_format($diff,2)."</td>";
                    if($diff<$deviations[$key.'l'] || $diff>$deviations[$key.'r'])
                    {
                        $html .= "<td style='padding: 5px;'><b>niezgodny</b></td>";
                        $error = true;
                    }
                    else
                    {
                        $html .= "<td style='padding: 5px;'>zgodne</td>";
                    }
                    $html .= "</tr>";
                }
            }
            $diff = $examination_result['bitum']-$curve['bitum'];
            $html .= "<tr>";
            $html .= "<td style='padding: 5px; text-align: right;'>zawartość asfaltu</td>";
            $html .= "<td style='padding: 5px;'>".$curve['bitum']."</td>";
            $html .= "<td style='padding: 5px;'>".$examination_result['bitum']."</td>";
            $html .= "<td style='padding: 5px; text-align: center;'>".$deviations['bituml']."/+".$deviations['bitumr']."</td>";
            $html .= "<td style='padding: 5px;'>".number_format($diff,2)."</td>";
            if($diff<$deviations['bituml'] || $diff>$deviations['bitumr'])
            {
                $html .= "<td style='padding: 5px;'><b>niezgodny</b></td>";
                $error = true;
            }
            else
            {
                $html .= "<td style='padding: 5px;'>zgodny</td>";
            }
            $html .= "</tr>";

            $html .= '</table>';

            $html .= '<h4>Wynik badania kontrolnego klasyfikuję jako: <u>'.$result.'</u> z krzywą uziarnienia mieszanki.</h4>';

            $html .= '<p style="float: right; width: 30%; text-align: center; margin-top: 100px; padding-right: 50px;">......................................<br />'.$certificate['creator'].'<br />'.$certificate['_date'].' '.$certificate['_time'].'</p>';

            $html .= '</div>';

            $mpdf = new mPDF('', 'A4', 0, '', 15, 15, 15, 0, 9, 9);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->debug = true;

            $mpdf->SetHTMLFooter('<hr><table width="100%"><tr><td style="font-size: 12px;font-family: Arial,serif; text-align: right;">Strona: {PAGENO} z {nbpg}</tr></table>');
            $mpdf->WriteHTML($html);

            $mpdf->Output("swiadectwo.pdf", 'I');
        }
    }
}