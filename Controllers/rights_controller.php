<?php
class rights_controller extends controller {

    public function defaults() {

        Permissions::checkPermission('rights_edit', true);

        $View = $this->loadView();
        $View -> defaults();

        $View -> render('defaults');

    }

}