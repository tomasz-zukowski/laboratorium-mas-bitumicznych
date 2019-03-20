<?php

class rights_model extends model {

    /**
     * Generowanie drzewka z uprawnieniami
     * @param bool $module
     * @param int $option {0 - clean list, 1 - default, 2 - user, 3 - group)
     * @param null $id - id uzytkownika lub grupy
     * @return string
     */
    public function getRightsFiles($module = false, $option = 0, $id = null) {

        /** wszystkie moduly lub jeden modul */
        try
        {
            if(empty($module))
            {
                $modules = Permissions::getModules();
            }
            else
            {
                if(Permissions::checkModule($module))
                {
                    $modules = $module;
                }
                else
                {
                    throw new Exception('Podany moduł jest niepoprawny lub nie istnieje!');
                }
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        if(!empty($modules))
        {
            $tree = array();

            foreach($modules as $mod)
            {
                if($this->hasRightFile($mod))
                {
                    $tree[] = RIGHTS_PAGES."/".$mod.".php";
                }
            }

            view::set('_rights_num',$this->getRightsIds($option,$id));

            return $tree;
        }

    }

    /**
     * Pobieranie id numerow potrzebnych do wyswietlenia czy uprawnienia sa nadane
     * @param int $option {0 - clean list, 1 - default, 2 - user, 3 - group)
     * @param null $id - id uzytkownika lub grupy
     * @return array|bool
     */
    public function getRightsIds($option, $id = null) {

        $rights_ids = array();

        if($option==1) /** defaultowe */
        {
            $_rights_ids = $this->getData("SELECT id FROM _rights_set WHERE _default = 1", false);

            if(!empty($_rights_ids))
            {
                foreach($_rights_ids as $ids)
                {
                    $rights_ids[] = $ids['id'];
                }
            }

            return $rights_ids;
        }
        elseif($option==2 && !is_null($id)) /** uzytkownika */
        {
            $_rights_ids = $this->getData("SELECT right_id FROM _rights_users WHERE user_id = '$id'", false);
            if(!empty($_rights_ids))
            {
                foreach($_rights_ids as $ids)
                {
                    $rights_ids[] = $ids['right_id'];
                }
            }

            return $rights_ids;
        }
        elseif($option==3 && !is_null($id)) /** grupy */
        {

            $_rights_ids = $this->getData("SELECT right_id FROM _rights_groups WHERE group_id = '$id'", false);
            if(!empty($_rights_ids))
            {
                foreach($_rights_ids as $ids)
                {
                    $rights_ids[] = $ids['right_id'];
                }
            }

            return $rights_ids;
        }
        else
        {
            return false;
        }
    }

    /**
     * Sprawdza czy modul posiada plik z drzewkiem uprawnień
     * @param $module
     * @return bool
     */
    public function hasRightFile($module)
    {
        if(is_file(RIGHTS_PAGES."/".$module.".php"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Zapisywanie uprawnień domyślnych
     * @param $post
     */
    public function saveDefaultRights($post) {

        $form = new form();

        if(!empty($post) && is_array($post))
        {
            $keys = array_keys($post);

            $this->runQuery("START TRANSACTION");

            if(!$this->runQuery("UPDATE _rights_set SET _default = 0"))
            {
                $form->setError('_others','Nie udało się wyzerować uprawnień');
            }

            foreach($keys as $key)
            {
                if(is_numeric($key))
                {
                    if(!$this->runQuery("UPDATE _rights_set SET _default = 1 WHERE id = '".$key."'"))
                    {
                        $form->setError('_others','Wystąpił błąd przy zapisywaniu uprawnień domyślnych');
                    }
                }
            }

            if($form->noErrors())
            {
                $this->runQuery("COMMIT");
                view::setAlertPanel('Uprawnienia domyślne zostały zapisane poprawnie!','success','/rights/defaults');
            }
            else
            {
                $this->runQuery("ROLLBACK");
                view::setAlertPanel('Wystapił błąd podczas zapisywania uprawnień','danger');
            }
        }
    }

    /**
     * Zapisywanie uprawnien użytkowników lub grup
     * @param $post
     * @param $id
     * @param null $group
     */
    public function saveRights($post, $id, $group = null) {

        $form = new form();

        if(!empty($post) && is_array($post) && !empty($id) && is_numeric($id))
        {
            $keys = array_keys($post);

            $this->runQuery("START TRANSACTION");

            if(is_null($group))
            {
                if(!$this->runQuery("DELETE FROM _rights_users WHERE user_id = '$id'"))
                {
                    $form->setError('_others', 'Nie udało się wyzerować uprawnień');
                }

                foreach($keys as $key)
                {
                    if(is_numeric($key))
                    {
                        if(!$this->runQuery("INSERT INTO _rights_users (user_id, right_id) VALUES ('$id','$key')"))
                        {
                            $form->setError('_others', 'Wystąpił błąd przy zapisywaniu uprawnień domyślnych');
                        }
                    }
                }
            }
            else
            {
                if(!$this->runQuery("DELETE FROM _rights_groups WHERE group_id = '$id'"))
                {
                    $form->setError('_others', 'Nie udało się wyzerować uprawnień');
                }

                foreach($keys as $key)
                {
                    if(is_numeric($key))
                    {
                        if(!$this->runQuery("INSERT INTO _rights_groups (group_id, right_id) VALUES ('$id','$key')"))
                        {
                            $form->setError('_others', 'Wystąpił błąd przy zapisywaniu uprawnień domyślnych');
                        }
                    }
                }
            }

            if($form->noErrors())
            {
                $this->runQuery("COMMIT");
                if(is_null($group))
                {
                    view::setAlertPanel('Uprawnienia zostały zapisane poprawnie!','success','/users/details/'.$id);
                }
                else
                {
                    view::setAlertPanel('Uprawnienia zostały zapisane poprawnie!','success','/users/groups/');
                }
            }
            else
            {
                $this->runQuery("ROLLBACK");
                view::setAlertPanel('Wystapił błąd podczas zapisywania uprawnień','danger');
            }

        }
    }
}