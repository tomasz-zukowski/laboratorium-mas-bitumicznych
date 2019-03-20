<?php

class database_view extends view {

    public function manage($params) {

        $year = $params[0];
        $month = $params[1];

        $Model = $this->loadModel();
        if(!empty($_POST))
        {
            (isset($_POST['tables']) && is_array($_POST['tables'])) ? $tables = $_POST['tables'] : $tables = null;

            if($Model -> saveTablesToFile($tables,$_POST['filename']))
            {
                $this->setAlertPanel('Backup bazy wykonany poprawnie');
            }
            else
            {
                if(!$this->isSetAlertPanel())
                {
                    $this->setAlertPanel('Wystąpił błąd','danger');
                }
            }
        }

        $this->set('year', $year);
        $this->set('month', $month);
        $this->set('backupList', $Model->getBackupList($year, $month));
        $this->set('proposal_backup_name', 'backup' . date("dmYHi"));
        $this->set('tables_list', $Model->getTablesList());

        $this->setTitle('Zarządzanie kopiami zapasowymi');
    }

    public function restore($params) {

        $year = $params[0];
        $month = $params[1];

        $Model = $this->loadModel();

        if(empty($_POST))
        {
            $this->setPromptWindow('confirmation',
                'Czy napewno przywrócić kopię bazy danych?',
                'Czy napewno chcesz przywrócić kopię bazy danych z pliku <b>'.$params[2].'</b>?<br /><br /> Wszystkie dane zostaną zastąpione!'.
                '<blockquote class="source-code source-code150">'.nl2br(trim(file_get_contents(SWAP_FILE.'/Backups/'.$params[2]))).'</blockquote>'.
                '<div class="text-right"><input class="btn btn-sm btn-default" type="submit" name="no" value="Anuluj" /> '.
                '<input class="btn btn-sm btn-success" type="submit" name="yes" value="Przywróć" /> </div>',
                'modal-lg',false,false,false,false,false,'POST','/database/restore/'.$year.'/'.$month.'/'.$params[2]);
        }

        /** zwracam model zeby mozna bylo wywolac metoda w widoku */

        $this->Model = $Model;

        $this->set('file_name',$params[2]);
        $this->set('year', $year);
        $this->set('month', $month);
        $this->set('backupList', $Model->getBackupList($year, $month));
        $this->set('proposal_backup_name', 'backup' . date("dmYHi"));
        $this->set('tables_list', $Model->getTablesList());
        $this->setTitle('Przywracanie kopii zapasowej bazy danych');
    }

}