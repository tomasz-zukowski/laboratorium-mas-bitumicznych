<?php

class navigation_controller extends controller
{
    public function links_list()
    {
        Permissions::checkPermission('navigation_links_list', true);

        $View = $this->loadView();
        $View->links_list();
        $View->render('links_list');
    }

    public function edit_link($params)
    {
        Permissions::checkPermission('navigation_link_edit', true);

        $View = $this->loadView();
        $View->edit_link($params);
        $View->render('edit_link');
    }

    public function delete_link($params)
    {
        Permissions::checkPermission('navigation_link_delete', true);

        $View = $this->loadView();
        $View->delete_link($params);
        $View->links_list();
        $View->render('links_list');
    }
}
