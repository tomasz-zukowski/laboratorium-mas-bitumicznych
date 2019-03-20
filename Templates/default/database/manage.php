<!DOCTYPE html>
<html>
    <head>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/header.php'; ?>
    </head>
    <body>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/main_nav_bar.php'; ?>
        <div class="container">
            <?php include 'Templates/'.$_SESSION['layout'].'/Const/alerts.php'; ?>
            <div class="row">
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-12">
                                    <i class="fa fa-database"></i> Kopie zapasowe
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 3%;">Lp</th>
                                        <th style="width: 60%;"><i class="fa fa-file-o"></i> Nazwa pliku</th>
                                        <th><i class="fa fa-calendar"></i> Data utworzenia</th>
                                        <th style="width: 5%;"></th>
                                    </tr>
                                </thead>
                                <tbody id="backups_list">
                                <?php
                                if($backups = $this->get('backupList'))
                                {
                                    $licznik = null;
                                    foreach($backups as $backup)
                                    {
                                        $licznik++;
                                        echo '<tr>
                                            <td>'.$licznik.'</td>
                                            <td><a href="/'.SWAP_FILE.'/Backups/'.$backup['name'].'">'.$backup['name'].'</a></td>
                                            <td>'.$backup['last_modify'].'</td>';
                                        if(Permissions::checkPermission('database_backup_restore'))
                                        {
                                            echo '<td><a href="/database/restore/'.$this->get('year').'/'.$this->get('month').'/'.$backup['name'].'"><i class="fa fa-undo"></i></a></td>';
                                        }
                                        else
                                        {
                                            echo '<td></td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                else
                                {
                                    ?>
                                    <tr>
                                        <td class="text-center text-info" colspan="5">Brak kopii zapasowych.</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer text-right">
                            <ul class="pagination pagination-sm" style="margin: -10px 10px;">
                                <li><a href='/database/manage/<?php echo ($this->get('year')-1).'/'.$this->get('month'); ?>'>&laquo;</a></li>
                                <li><a><?php echo $this->get('year'); ?></a></li>
                                <li><a href='/database/manage/<?php echo ($this->get('year')+1).'/'.$this->get('month'); ?>'>&raquo;</a></li>
                            </ul>
                            <ul class="pagination pagination-sm" style="margin: -10px;">
                                <li><a href='/database/manage/<?php echo date('Y/m',mktime(0,0,0,($this->get('month')),0,$this->get('year'))); ?>'>&laquo;</a></li>
                                <li><a style="width: 100px; text-align: center;"><?php echo $_SESSION['PL_months'][(int) $this->get('month')-1]; ?></a></li>
                                <li><a href='/database/manage/<?php echo date('Y/m',mktime(0,0,0,($this->get('month'))+2,0,$this->get('year'))); ?>'>&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                if(Permissions::checkPermission('database _backup_new'))
                {
                ?>
                <div class="col-sm-4">
                    <form action="<?php echo $_this_path; ?>" method="POST">
                        <div class="panel panel-default">
                            <div class="panel-heading">Nowa kopia</div>
                            <div class="panel-body">
                                <div class="form-group <?php echo $this->get('form-errors','filename','class'); ?>">
                                    <label>Nowa kopia zapasowa</label>
                                    <input class="form-control" type="text" name="filename" value="<?php echo (isset($_POST['filename'])) ? $_POST['filename'] : $this->get('proposal_backup_name'); ?>" placeholder="Nazwa kopii" required />
                                    <a class="help-block"><?php echo $this->get('form-errors','filename','error-msg'); ?></a>
                                </div>
                                <div class="form-group small <?php echo $this->get('form-errors','tables','class'); ?>">
                                    <label>
                                        <input type="radio" name="export" value="all_tables" id="all_tables" checked> Cała baza danych
                                    </label>
                                </div>
                                <div class="form-group small <?php echo $this->get('form-errors','tables','class'); ?>">
                                    <label>
                                        <input type="radio" name="export" value="selected_tables" id="selected_tables"> Wybrane tabele
                                    </label>
                                </div>
                                <div id="db_tables" style="margin-left: 20px; max-height: 250px; overflow-y: auto; display: none;">
                                    <?php
                                    for($i=0;$i<count($tables = $this->get('tables_list'));$i++)
                                    {
                                    ?>
                                        <label class="checkbox">
                                        <input name="tables[]" value="<?php echo $tables[$i]; ?>" type="checkbox" class="checkbox" checked disabled /><?php echo $tables[$i] ?>
                                        </label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary btn-sm">Utwórz</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>