<?php

class navigation_model extends model {

    /** magazyn na linki */
    public $links;

    /**
     * Pobieranie linków z bazy danych i zapisywanie do $this->links;
     */
    public function setLinks() {

        $links = $this->getData("SELECT
                                          _conf_navigation_links.*,
                                          (SELECT IF(_rights_set.right_name IS NOT NULL, _rights_set.right_name, 'asd')
                                           FROM _rights_set
                                           WHERE _rights_set.id = _conf_navigation_links._permission) AS permission
                                        FROM _conf_navigation_links
                                        ORDER BY _possition, link", false);

        for($i=0;$i<count($links);$i++)
        {
            if(is_null($links[$i]['permission']))
                $links[$i]['permission']=true;
        }

        $this->links = $links;
    }

    /**
     * Pobieranie linków - rodziców
     *
     */
    public function getParents($skip=null) {

        if(is_null($skip))
        {
            return $this->getData("SELECT _conf_navigation_links.* FROM _conf_navigation_links WHERE _parent = 0", false);
        }
        else
        {
            return $this->getData("SELECT _conf_navigation_links.* FROM _conf_navigation_links WHERE _parent = 0 AND id!='$skip'", false);
        }

    }

    /**
     * Sprawdzenie czy rodzic ma dzieci
     * @param $parent
     * @param bool $active - czy zwracać tylko aktywne linki (dzieci)
     * @return array|bool|null
     */
    public function hasChildren($parent=null, $active = false) {

        if(!empty($parent) || is_string($parent))
        {
            if($active==false)
            {
                return $this->getData("SELECT _conf_navigation_links.* FROM _conf_navigation_links WHERE _parent = '$parent'", false);
            }
            else
            {
                return $this->getData("SELECT _conf_navigation_links.* FROM _conf_navigation_links WHERE _active = '1' AND _parent = '$parent'", false);
            }
        }
        else
        {
            return false;
        }

    }

    /**
     * Pobieranie linków
     * @param null $link
     * @return bool|null
     */
    public function getLinks($link = null) {

        if(is_null($link))
        {
            if(!empty($this->links) && is_array($this->links))
            {
                return $this->links;
            }
            else
            {
                return false;
            }
        }
        else
        {
            foreach($this->links as $links)
            {
                if($links['id']==$link)
                {
                    return $links;
                }
            }

            return false;
        }
    }

    /**
     * Rejestracja nowego linku nawigacyjnego
     * @param $post - tablica %_POST z danymi formularza
     * @return bool
     */
    public function newLink($post) {

        $form = new form();

        if(!empty($post) && is_array($post))
        {
            $name         = $form->prepareForQuery($post['name']);
            $description  = $form->prepareForQuery($post['description']);
            $localization = $form->prepareForQuery($post['localization']);
            $permission   = (int) $post['permission'];
            $parent       = (int) $post['parent'];
            $possition    = (int) $post['possition'];

            if($parent==0)
            {
                if(!$this->freeLinkName($name))
                {
                    $form->setError('name','Link o takiej nazwie już istnieje! ');
                }
            }

            if(!$form->checkAlphabetical($name,'/^[a-z A-ZZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.,]+$/'))
            {
                $form->setError('name','Dopuszczalne znaki a-zA-Z.,');
            }

            if(!$form->checkAlphabetical($description,'/^[a-z A-ZZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.,]+$/'))
            {
                $form->setError('description','Dopuszczalne znaki a-zA-Z\.,');
            }

            if(!$form->checkAlphabetical($localization,'/^[a-z\\_\/]+$/'))
            {
                $form->setError('localization','Dopuszczalne znaki a-z_\\\/');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("INSERT INTO _conf_navigation_links (link, description, location, _permission, _parent, _possition)
                                      VALUES ('$name','$description','$localization','$permission','$parent','$possition')"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Link został pomyślnie dodany','success');
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas dodawania nowego linku do bazy danych! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas dodawania nowego linku !','danger',null, null);
                view::set('form_errors',$form->getErrors());
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Edycja linku nawigacyjnego
     * @param $post - tablica $_POST z danymi z formularza
     * @return bool
     */
    public function editLink($post) {

        $form = new form();

        if(!empty($post) && is_array($post))
        {
            $id           = (int) $post['id'];

            $name         = $form->prepareForQuery($post['name']);
            $description  = $form->prepareForQuery($post['description']);
            $localization = $form->prepareForQuery($post['localization']);
            $permission   = (int)$post['permission'];

            if(!empty($post['parent']))
            {
                $parent   = (int) $post['parent'];
            }
            else
            {
                $parent   = 0;
            }
            $active       = (int) $post['active'];
            $possition    = (int) $post['possition'];

            $this->setLinks();
            $link = $this->getLinks($id);

            if($parent==0 && !$form->checkEqual($link['link'],$name))
            {
                if(!$this->freeLinkName($name))
                {
                    $form->setError('name','Link o takiej nazwie już istnieje!');
                }
            }

            if(!$form->checkAlphabetical($name,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.,]+$/'))
            {
                $form->setError('name','Dopuszczalne znaki a-zA-Z.,');
            }

            if(!$form->checkAlphabetical($description,'/^[a-z A-ZÓóŁłĄąŻżŹźŚśĆćĘęŃń\.,]+$/'))
            {
                $form->setError('description','Dopuszczalne znaki a-zA-Z\.,');
            }

            if(!$form->checkAlphabetical($localization,'/^[a-z\\_\/]+$/'))
            {
                $form->setError('localization','Dopuszczalne znaki a-z_\\\/');
            }

            if($form->noErrors())
            {
                $this->runQuery("START TRANSACTION");

                if($this->runQuery("UPDATE _conf_navigation_links
                                        SET link = '$name', description = '$description', location = '$localization', _permission = '$permission', _parent = '$parent', _possition = '$possition', _active = '$active'
                                        WHERE id = '$id'"))
                {
                    $this->runQuery("COMMIT");
                    view::setAlertPanel('Link został zaktualizowany','success','/navigation/links_list',3);
                }
                else
                {
                    $this->runQuery("ROLLBACK");
                    view::setAlertPanel('Wystąpił błąd podczas edycji linku! Skontaktuj się z administratorem.','danger',null,null);
                    $form->setError('_others','Wystąpił błąd. Skontaktuj się z administratorem');
                }
            }
            else
            {
                view::setAlertPanel('Wystąpił błąd podczas edycji linku !','danger',null, null);
                view::set('form_errors',$form->getErrors());
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Usuwanie linku nawigacyjnego wraz z wygenerowaniem odpowiedniego komunikatu
     * @param $link
     */
    public function deleteLink($link) {

        if($this->getLinks($link) && isset($link) && is_numeric($link))
        {
            if(!$this->hasChildren($link))
            {
                if($this->runQuery("DELETE FROM _conf_navigation_links WHERE id = '$link'"))
                {
                    view::setAlertPanel('Link został poprawnie usunięty', 'success', '/navigation/links_list', '3');
                }
                else
                {
                    view::setAlertPanel('Wystapił błąd podczas usuwania linku!', 'danger', null, null);
                }
            }
        }
        else
        {
            view::setAlertPanel('Wystapił błąd podczas usuwania linku!', 'danger', null, null);
        }

    }


    /**
     * Generowanie kodu nawigacji
     * @return bool
     */
    public function renderNavigation() {

    try
    {
        if(!empty($this->links) && is_array($this->links))
        {
            foreach($this->links as $link)
            {
                if($link['_parent']==0)
                {
                    if(!$this->hasChildren($link['id'],true))
                    {
                        if(Permissions::checkPermission($link['permission']) && $link['_active']==1)
                        {
                            echo '<li><a href="/'.$link['location'].'">' . $link['link'] . '</a></li>';
                        }
                    }
                    else
                    {
                        if(Permissions::checkPermission($link['permission']) && $link['_active']==1)
                        {
                            echo "<li class='dropdown'>";
                            echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $link['link'] . '<span class="caret"></span></a>';
                            echo '<ul class="dropdown-menu" role="menu">';
                            foreach($this->links as $temp_link)
                            {
                                if($temp_link['_parent'] == $link['id'])
                                {
                                    if(Permissions::checkPermission($temp_link['permission']) && $temp_link['_active']==1)
                                    {
                                        echo '<li><a href="/' . $temp_link['location'] . '">' . $temp_link['link'] . '</a></li>';
                                    }
                                }
                            }
                            echo '</ul>';
                            echo "</li>";
                        }
                    }

                }
            }
        }
        else
        {
            throw new Exception('You should first run getLinks();');
        }
    }
    catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
            exit;
        }
    }

    /**
     * Pobranie listy uprawnień
     */
    public function getPermissionsList() {

        return $this->getData("SELECT id, right_name FROM _rights_set ORDER BY right_name", false);

    }

    /**
     * Sprawdzenie czy nazwa linku jest zajeta
     * @param $link
     * @return bool
     */
    public function freeLinkName($link)
    {
        if($this->getData("SELECT id
                            FROM _conf_navigation_links
                            WHERE link = '$link'"))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}