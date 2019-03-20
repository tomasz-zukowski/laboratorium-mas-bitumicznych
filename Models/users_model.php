<?php

class users_model extends model {

    /**
     * Logowanie
     * @param null $login
     * @param null $pass
     */
    public function log_in($login=null, $pass=null)
    {

        if(!is_null($login) && !is_null($pass))
        {
            $form = new form();

            $login = $form->prepareForQuery($login);
            $pass  = $form->prepareForQuery($pass);

            $matched = $this->getData("SELECT * FROM _users_list WHERE login = '" . $login . "' AND password = '" . sha1($pass) . "' AND _active = 1 LIMIT 1", true);

            if(!$form->checkEqual(sha1($pass),$matched['password']))
            {
                $form->setError('password','Nieprawidłowy login i/lub hasło');
            }

            if(!empty($matched) && $form->noErrors())
            {
                $_SESSION['id']   = $matched['id'];
                $_SESSION['user'] = $matched['surname'] . " " . $matched['forename'];

                /**
                 * jeżeli użytownik to administrator pobierz cały zestaw uprawnień
                 * sprawdzenie czy użytkownik należy do grupy
                 */

                if($matched['group'] > 1) /** przypisuje uprawniania dla grupy */
                {
                    Permissions::setRights($this->getData("SELECT _rights_groups.*, _rights_set.right_name
                                                            FROM _rights_groups
                                                            JOIN _rights_set
                                                            ON _rights_groups.right_id = _rights_set.id
                                                            WHERE _rights_groups.group_id = '" . $matched['group'] . "';", false));
                }
                elseif($matched['group'] == 0) /** brak grupy - przypisuje uprawnienia indywidualne */
                {
                    Permissions::setRights($this->getData("SELECT _rights_users.*, _rights_set.right_name
                                                            FROM _rights_users
                                                            JOIN _rights_set
                                                            ON _rights_users.right_id = _rights_set.id
                                                            WHERE _rights_users.user_id = '" . $matched['id'] . "' ", false));
                }
                elseif($matched['group'] == 1) /** administratorzy */
                {
                    Permissions::setRights($this->getData("SELECT * FROM _rights_set", false));
                }

                if(!isset($_SESSION['request_url']))
                {
                    Permissions::forwarding('/home/index');
                }
                else
                {
                    Permissions::forwarding($_SESSION['request_url']);
                }
            }
            else
            {
                view::set('form_errors', $form->getErrors());
            }
        }
    }

    /**
     * Pobieranie użytkowników wszystkich (z grupy) |konkretnego
     * @param null $id
     * @param null $group
     * @return array|bool|null
     */
    public function getUsers($id = null, $group = null)
    {
        if($id === null)
        {
            if(!isset($group))
            {
                return ($this->getData("SELECT _users_list.*, _users_groups.type_name AS group_name
                                    FROM _users_list
                                    JOIN _users_groups
                                    ON _users_groups.id = _users_list.`group`
                                    WHERE _users_list._active = 1
                                    ORDER BY surname ASC, forename DESC", false));
            }
            else
            {
                if(is_numeric($group))
                {
                    return ($this->getData("SELECT _users_list.*, _users_groups.type_name AS group_name
                                    FROM _users_list
                                    JOIN _users_groups
                                    ON _users_groups.id = _users_list.`group`
                                    AND _users_groups.id = '$group'
                                    WHERE _users_list._active = 1
                                    ORDER BY surname ASC, forename DESC", false));
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return ($this->getData("SELECT _users_list.*, _users_groups.type_name AS group_name
                                    FROM _users_list
                                    JOIN _users_groups
                                    ON _users_groups.id = _users_list.`group`
                                    WHERE _users_list.id = '$id'
                                    AND _users_list._active = 1
                                    LIMIT 1", true));
        }
    }

    /**
     * Pobieranie listy grup lub danych konkretnej grupy
     * @param null $id
     * @return array|bool|null
     */
    public function getGroups($id = null, $active = null)
    {
        $filtr = '';

        if($active!=null)
        {
            if($active==true)
            {
                $filtr = "AND _active = '1'";
            }
            else
            {
                $filtr = "AND _active = '0'";
            }
        }


        if($id === null)
        {
            return ($this->getData("SELECT *
                                    FROM _users_groups
                                    WHERE 1 = 1
                                    $filtr
                                    ORDER BY type_name ASC", false));
        }
        else
        {
            return ($this->getData("SELECT *
                                    FROM _users_groups
                                    WHERE _users_groups.id = '$id'
                                    $filtr
                                    LIMIT 1", true));
        }
    }

    /**
     * Sprawdzenie czy login jest zajety
     * @param $login
     * @return bool
     */
    public function freeUserLogin($login)
    {
        if($this->getData("SELECT id
                            FROM _users_list
                            WHERE login = '$login'"))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Sprawdzenie czy nazwa grupy jest zajeta
     * @param $group
     * @return bool
     */
    public function freeGroupName($group)
    {
        if($this->getData("SELECT id
                            FROM _users_groups
                            WHERE type_name = '$group'"))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Walidacja i operacje wiązace
     * @param $post
     * @return array|bool
     */
    public function newUser($post) {

        $form = new form();

        if(!empty($post) && is_array($post))
        {
            $surname    = ucfirst($form->prepareForQuery($post['surname']));
            $forename   = ucfirst($form->prepareForQuery($post['forename']));
            $login      = $form->prepareForQuery($post['login']);
            $password   = $form->prepareForQuery($post['password']);
            $password_2 = $form->prepareForQuery($post['password_2']);
            $email      = $form->prepareForQuery($post['email']);
            $group      = $post['group'];

            if(!$form->checkAlphabetical($surname))
            {
                $form->setError('surname','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkAlphabetical($forename))
            {
                $form->setError('forename','Niedozwolony znak. Dozwolone są tylko litery.');
            }

            if(!$form->checkExpression($login, '/^[a-z0-9_]{4,12}$/i'))
            {
                $form->setError('login','Od 4 do 12 znaków. Dopuszczalne są małe i duże litery (bez polskich znaków), cyfry oraz znak podkreślenia.');
            }

            if(!$this->freeUserLogin($login))
            {
                $form->setError('login','Użytkownik o takim loginie już istnieje');
            }

            if(!$form->checkExpression($password, '/[a-zA-Z0-9]{4,8}/i'))
            {
                $form->setError('password','Od 4 do 8 znaków. Dopuszczalna są małe i duże litery (bez polskich znaków), cyfry oraz znak podkreślenia. Wymaga użycia przynajmniej jednej cyfry.');
            }

            if(!$form->checkEqual($password, $password_2, true))
            {
                $form->setError('password','Podane hasła muszą być jednakowe');
            }

            if(!$form->checkEmail($email))
            {
                $form->setError('email','Adres email musi mieć prawidłowy format.');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery('INSERT INTO _users_list (`forename`, `surname`, `email`, `login`, `password`, `group`)
                                      VALUES ("'.$forename.'","'.$surname.'","'.$email.'","'.$login.'","'.sha1($password).'","'.$group.'")'))
                {

                    $new_user_id = $this->pdo->lastInsertId();

                    /** nadanie podstawowego zestawu uprawnień */
                    if($default_rights = $this->getData("SELECT * FROM _rights_set WHERE _default = '1'", false))
                    {
                        foreach($default_rights as $right)
                        {
                            if(!$this->runQuery("INSERT INTO _rights_users (user_id, right_id) VALUES ('" . $new_user_id . "','" . $right['id'] . "')"))
                            {
                                $error = true;
                            }
                        }
                    }

                    if(!isset($error))
                    {
                        $this->runQuery("COMMIT");
                        view::setAlertPanel('Użytkownik zarejestrowany !','success','/users/details/'.$new_user_id);
                        return true;
                    }
                    else
                    {
                        $this->runQuery("ROLLBACK");
                        view::setAlertPanel('Wystąpił błąd podczas nadawania uprawnień ! Skontaktuj się z administratorem.','danger',null,null);
                        $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                        return false;
                    }
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestracji użytkownika !','danger',null, null);
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
     * Edycja użytkownika
     * @param $post
     * @param $id
     * @return mixed
     */
    public function editUser($post, $id) {

        $form = new form();

        if(!empty($post) && is_array($post) && !empty($id) && is_numeric($id))
        {
            /** zmiana podstawowych informacji */
            if(isset($post['surname'],$post['forename'],$post['login']))
            {
                $surname  = ucfirst($form->prepareForQuery($post['surname']));
                $forename = ucfirst($form->prepareForQuery($post['forename']));
                $login    = $form->prepareForQuery($post['login']);
                $email    = $form->prepareForQuery($post['email']);

                $info = $this->getUsers($id);

                if(!$form->checkAlphabetical($surname))
                {
                    $form->setError('surname','Niedozwolony znak. Dozwolone są tylko litery.');
                }

                if(!$form->checkAlphabetical($forename))
                {
                    $form->setError('forename','Niedozwolony znak. Dozwolone są tylko litery.');
                }

                if(!$form->checkExpression($login,'/^[a-z0-9_]{4,12}$/i'))
                {
                    $form->setError('login','Od 4 do 12 znaków. Dopuszczalne są małe i duże litery (bez polskich znaków), cyfry oraz znak podkreślenia.');
                }

                if(!$form->checkEqual($login,$info['login']))
                {
                    if(!$this->freeUserLogin($login))
                    {
                        $form->setError('login','Użytkownik o takim loginie już istnieje');
                    }
                }

                if(!$form->checkEmail($email))
                {
                    $form->setError('email','Adres email musi mieć prawidłowy format.');
                }

                if($form->noErrors())
                {
                    if($this->runQuery('UPDATE _users_list SET `forename` = "' . $forename . '", `surname` = "' . $surname . '", `email` = "' . $email . '", `login` = "' . $login . '" WHERE id = "' . $id . '"'))
                    {
                        view::setAlertPanel('Dane użytkownika zostały uaktualnione !','success','/users/details/'.$id);
                    }
                    else
                    {
                        view::setAlertPanel('Wystąpił błąd','danger');
                    }
                }
                else
                {
                    view::setAlertPanel('Wystąpił błąd, należy sprawdzić poprawność danych !', 'danger', null, null);
                    view::set('form_errors',$form->getErrors());
                }
            }

            /** zmiana hasła */
            if(isset($post['old_password'], $post['new_password'], $post['new_password_2']))
            {
                $old_password   = $form->prepareForQuery($post['old_password']);
                $new_password   = $form->prepareForQuery($post['new_password']);
                $new_password_2 = $form->prepareForQuery($post['new_password_2']);

                $info = $this->getUsers($id);

                if(!$form->checkEqual(sha1($old_password),$info['password']))
                {
                    $form->setError('old_password','Podane hasło jest niepoprawne!');
                }

                if(!$form->checkExpression($new_password, '/[a-zA-Z0-9]{4,8}/i'))
                {
                    $form->setError('new_password','Od 4 do 8 znaków. Dopuszczalna są małe i duże litery (bez polskich znaków), cyfry oraz znak podkreślenia. Wymaga użycia przynajmniej jednej cyfry.');
                }

                if(!$form->checkEqual($new_password,$new_password_2))
                {
                    $form->setError('new_password','Podane hasła muszą być jednakowe');
                }

                if($form->noErrors())
                {
                    if($this->runQuery('UPDATE _users_list SET `password` = "' . sha1($new_password) . '" WHERE id = "' . $id . '"'))
                    {
                        view::setAlertPanel('Hasło zostało zmienione !','success','/users/details/'.$id);
                    }
                    else
                    {
                        view::setAlertPanel('Wystąpił błąd','danger');
                    }
                }
                else
                {
                    view::set('form_errors',$form->getErrors());
                }
            }

            if(isset($post['group']))
            {
                $group = (int) $post['group'];

                if($this->runQuery('UPDATE _users_list SET `group` = "'.$group.'" WHERE id = "'.$id.'"'))
                {
                    view::setAlertPanel('Przynależność użytkownika do grupy została zmieniona !','success','/users/details/'.$id);
                }
                else
                {
                    view::setAlertPanel('Wystąpił błąd','danger');
                }
            }

            if(Permissions::checkModule('rights'))
            {

                if(isset($post['rights']))
                {
                    $Rights_model = $this->loadModel('rights_model');
                    $Rights_model->saveRights($post,$id);
                }
            }
        }
        else
        {
            return false;
        }

    }

    public function newGroup($post) {

        $form = new form();

        if(!empty($post) && is_array($post))
        {
            $name        = ucfirst($form->prepareForQuery($post['name']));
            $description = $form->prepareForQuery($post['description']);
            $active      = (int) $post['active'];

            if(!$this->freeGroupName($name))
            {
                $form->setError('name','Grupa o takiej nazwie już istnieje!');
            }

            if(!$form->checkExpression($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\., 0-9]+$/'))
            {
                $form->setError('name','Niedozwolony znak');
            }

            if(!$form->checkExpression($description,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\., 0-9]+$/'))
            {
                $form->setError('description','Niedozwolony znak');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO _users_groups (type_name, description, _active) VALUES ('$name','$description','$active')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Grupa użytkowników została zapisana!','success','/users/groups',3);
                }
                else
                {

                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas rejestrowania grupy! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas rejestrowania grupy !','danger',null, null);
                view::set('form_errors',$form->getErrors());
            }

        }
        else
        {
            return false;
        }
    }

    public function editGroup($post, $id) {

        $form = new form();

        if(!empty($post) && is_array($post) && !empty($id) && is_numeric($id))
        {
            if(!empty($post['name']))
            {
                $name        = ucfirst($form->prepareForQuery($post['name']));
                $description = $form->prepareForQuery($post['description']);
                $active      = (int)$post['active'];

                $group = $this->getGroups($id);

                if(!$form->checkEqual($name, $group['type_name']))
                {
                    if(!$this->freeGroupName($name))
                    {
                        $form->setError('name', 'Grupa o takiej nazwie już istnieje!');
                    }
                }

                if(!$form->checkExpression($name, '/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\., 0-9]+$/'))
                {
                    $form->setError('name', 'Niedozwolony znak');
                }

                if(!$form->checkExpression($description, '/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\., 0-9]+$/'))
                {
                    $form->setError('description', 'Niedozwolony znak');
                }

                if($form->noErrors())
                {
                    $this->runQuery("START TRANSACTION");

                    if($this->runQuery("UPDATE _users_groups SET type_name = '$name', description = '$description', _active = '$active' WHERE id = '$id'"))
                    {
                        $this->runQuery("COMMIT");
                        view::setAlertPanel('Zmiany w grupie zostały zapisane !', 'success', '/users/groups/', 3);
                    }
                    else
                    {

                        $this->runQuery("ROLLBACK");
                        view::setAlertPanel('Wystąpił błąd podczas edycji grupy! Skontaktuj się z administratorem.', 'danger', null, null);
                        $form->setError('_others', 'Wystąpił błąd. Skontaktuj się z administratorem');
                    }
                }
                else
                {
                    view::setAlertPanel('Wystąpił błąd podczas edycji grupy !', 'danger', null, null);
                    view::set('form_errors', $form->getErrors());
                }
            }

            if(!empty($post['rights']))
            {
                if(Permissions::checkModule('rights'))
                {
                    if(isset($post['rights']))
                    {
                        $Rights_model = $this->loadModel('rights_model');
                        $Rights_model->saveRights($post,$id, true);
                    }
                }
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Usuwanie użytkownika wraz z wygenerowaniem odpowiedniego komunikatu
     * @param $user
     */
    public function deleteUser($user) {

        if($this->getUsers($user) && isset($user) && is_numeric($user))
        {
            if($this->runQuery("UPDATE _users_list SET _active = 0 WHERE id = '$user'"))
            {
                view::setAlertPanel('Użytkownik został poprawnie usunięty', 'success', '/users/manage', '3');
            }
            else
            {
                view::setAlertPanel('Wystapił błąd podczas usuwania użytkownika!', 'danger', null, null);
            }
        }
        else
        {
            view::setAlertPanel('Wystapił błąd podczas usuwania użytkownika!', 'danger', null, null);
        }

    }

    /**
     * Usuwanie grupy wraz z wygenerowaniem odpowiedniego komunikatu
     * @param $group
     */
    public function deleteGroup($group) {

        /** zabezpieczenie przed usunieciem wymaganych grup */
        if($group==0 || $group==1)
        {
            view::setAlertPanel('Nie możesz usunąć wbudowanych grup!', 'danger','/users/groups/',3);
        }

        if($this->getGroups($group) && isset($group) && is_numeric($group))
        {
            if($this->runQuery("DELETE FROM _users_groups WHERE id = '$group'")
                && $this->runQuery("DELETE FROM _rights_groups WHERE group_id = '$group'"))
            {
                $this->runQuery("UPDATE _users_groups WHERE id = '$group'");
                view::setAlertPanel('Grupa użytkowników została poprawnie usunięta', 'success', '/users/groups', '3');
            }
            else
            {
                view::setAlertPanel('Wystapił błąd podczas usuwania grupy użytkowników!', 'danger', null, null);
            }
        }
        else
        {
            view::setAlertPanel('Wystapił błąd podczas usuwania grupy użytkowników!', 'danger', null, null);
        }

    }
}