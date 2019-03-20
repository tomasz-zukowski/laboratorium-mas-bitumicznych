<?php

class database_controller extends controller {

    public function manage($params) {

        Permissions::checkPermission('database_backups', true);

        if(empty($params) || !checkdate($params[1],1,$params[0]))
        {
            Permissions::forwarding('/database/manage/'.date('Y').'/'.date('m'));
        }

        $View = $this->loadView();
        $View->manage($params);

        $View->render('manage');

    }

    public function restore($params) {

        Permissions::checkPermission('database_backup_restore', true);

        if(empty($params) || !is_file(SWAP_FILE."/Backups/".$params[2]))
        {
            Permissions::forwarding('/database/manage/');
        }

        $View = $this->loadView();
        $View->restore($params);

        $View->render('restore');
    }
}