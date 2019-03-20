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
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6">
                            <i class="fa fa-flask"></i> Zlecanie nowego badania
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_examination_list'))
                            {
                                echo '<a href="/lab/examinations"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrot</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?php echo $_this_path; ?>">
                        <table class="table">
                            <tr>
                                <td style="width: 30%;"><i class="fa fa-fw fa-user"></i> Klient</td>
                                <td><i class="fa fa-fw fa-truck"></i> Budowa</td>
                                <td style="width: 25%;" colspan="2"><i class="fa fa-fw fa-users"></i> Osoba kontaktowa</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','client','class'); ?>">
                                        <select class="form-control" id="client" name="client">
                                            <option value="0">Wybierz</option>
                                            <?php
                                            foreach($this->get('clients') as $client)
                                            {
                                                echo "<option value='".$client['id']."'>".$client['name']." - ".$client['post_code']." ".$client['city']."</option>";
                                            }
                                            ?>
                                        </select>
                                        <a class="help-block"><?php echo $this->get('form_errors','client','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','client_building','class'); ?>">
                                        <select class="form-control" id="client_building" name="client_building">
                                            <option value="0">Wybierz klienta</option>
                                            <?php
                                            foreach($this->get('groups') as $group)
                                            {
                                                echo "<option value='".$group['id']."'>".$group['type_name']."</option>";
                                            }
                                            ?>
                                        </select>
                                        <a class="help-block"><?php echo $this->get('form_errors','client_building','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','client_contact','class'); ?>">
                                        <select class="form-control" id="client_contact" name="client_contact">
                                            <option value="0">Wybierz klienta</option>
                                            <?php
                                            foreach($this->get('groups') as $group)
                                            {
                                                echo "<option value='".$group['id']."'>".$group['type_name']."</option>";
                                            }
                                            ?>
                                        </select>
                                        <a class="help-block"><?php echo $this->get('form_errors','client_contact','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-fw fa-calendar-o"></i> Termin badania</td>
                                <td colspan="2"><i class="fa fa-fw fa-cube"></i> Rodzaj badania</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group margin-bottom-sm <?php echo $this->get('form_errors','date','class'); ?>">
                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                        <input class="form-control" id="examination_date" type="date" name="date" value="<?php echo (isset($_POST['date'])) ? $_POST['date'] : ""; ?>" placeholder="Data badania [rrrr-mm-dd]" required />
                                    </div>
                                    <a class="help-block" id="date_help"></a>
                                </td>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','examination_type','class'); ?>">
                                        <select class="form-control" name="examination_type">
                                            <?php
                                            foreach($this->get('examination_types') as $type)
                                            {
                                                echo "<option value='".$type['id']."'>".$type['symbol']." - ".$type['standard_name']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                <div class="row">
                                    <div class="col-sm-12"><p><i class="fa fa-fw fa-info"></i> <label>Informacje o próbce</label></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Czy próbka została dostarczona?</label>
                                        <p><input type="radio" id="sample_status_yes" name="sample_status" value="1" required /> Tak</p>
                                        <p><input type="radio" id="sample_status_no" name="sample_status" value="0" /> Nie</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <div id="yes_sample" style="display: none;">
                                            <label>Numer próbki</label>
                                            <div class="form-group <?php echo $this->get('form_errors','date','class'); ?>">
                                                <input class="form-control" id="yes_sample_number" type="text" name="number_yes" value="<?php echo (isset($_POST['number'])) ? $_POST['number'] : ""; ?>" placeholder="Numer próbki" />
                                                <a class="help-block"><?php echo $this->get('form_errors','date','error_msg'); ?></a>
                                            </div>
                                        </div>
                                        <div id="no_sample" style="display: none;">
                                            <label>Sposób dostarczenia próbki</label>
                                            <p><input type="radio" id="no_sample_method_sending" name="sample_method" value="1" /> Wysyłka</p>
                                            <p><input type="radio" id="no_sample_method_collection" name="sample_method" value="0" /> Odbiór</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div id="no_sample_collection" style="display: none;">
                                            <label>Data odbioru</label>
                                            <div class="form-group <?php echo $this->get('form_errors','collection_date','class'); ?>">
                                                <input class="form-control" id="no_sample_collection_date" type="date" name="collection_date" value="<?php echo (isset($_POST['collection_date'])) ? $_POST['collection_date'] : date("Y-m-d"); ?>" placeholder="Data odbioru [rrrr-mm-dd]" />
                                                <a class="help-block"><?php echo $this->get('form_errors','collection_date','error_msg'); ?></a>
                                            </div>

                                            <label>Numer próbki</label>
                                            <div class="form-group <?php echo $this->get('form_errors','date','class'); ?>">
                                                <input class="form-control" id="no_sample_collection_number" type="text" name="number_no_collection" value="<?php echo (isset($_POST['number'])) ? $_POST['number'] : ""; ?>" placeholder="Numer próbki" />
                                                <a class="help-block"><?php echo $this->get('form_errors','date','error_msg'); ?></a>
                                            </div>
                                        </div>
                                        <div id="no_sample_sending" style="display: none;">
                                            <label>Numer próbki</label>
                                            <div class="form-group <?php echo $this->get('form_errors','date','class'); ?>">
                                                <input class="form-control" id="no_sample_sending_number" type="text" name="number_no_sending" value="<?php echo (isset($_POST['number'])) ? $_POST['number'] : ""; ?>" placeholder="Numer próbki" />
                                                <a class="help-block"><?php echo $this->get('form_errors','date','error_msg'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <input type="submit" class="btn btn-sm btn-primary disabled" id="submit" value="Zleć badanie" style="float: right;" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>