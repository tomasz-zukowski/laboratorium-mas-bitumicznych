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
                            <i class="fa fa-line-chart"></i> Rejestracja wyników pomiarów próbki <a><?php echo $this->get('examination','sample_number'); ?></a>. Badanie <a><?php echo $this->get('info','symbol'); ?></a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_examination_type'))
                            {
                                echo '<a href="/lab/examination/'.$this->get('examination','id').'"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?php echo $_this_path; ?>">
                        <div class="row">
                            <div class="col-sm-4" style="background: url('/Templates/default/images/sieves.png'); width: 146px; height: 473px;">

                            </div>
                            <div class="col-sm-4">
                                <h4>Wartości odsiewu próbki</h4>
                                <?php
                                $sieves = $this->get('sieves');
                                $sieves_set = array_reverse($this->get('sieves_set'));
                                foreach($sieves_set as $key=>$value)
                                {
                                    if(isset($sieves[$key.'l']))
                                    {
                                        echo "<label>Sito ".$value." [mm]</label>";
                                        echo "<div class='form-group ".$this->get('form_errors',$key,'class')."'>";
                                        $input_value = (isset($_POST[$key])) ? $_POST[$key] : "";
                                        echo '<input class="form-control" type="text" name="'.$key.'" placeholder="Wartość" value="'.$input_value.'" required min="0" />';
                                        echo '<a class="help-block">'.$this->get('form_errors',$key,'error_msg').'</a>';
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <h4>&ensp;</h4>
                                <label>Zawartość asfaltu</label>
                                <div class="form-group <?php echo $this->get('form_errors','bitum','class'); ?>">
                                    <input class="form-control" type="text" name="bitum" placeholder="Zawartość asfaltu" value="<?php echo (isset($_POST['bitum'])) ? $_POST['bitum'] : ""; ?>" required min="0" />
                                    <a class="help-block"><?php echo $this->get('form_errors','bitum','error_msg'); ?></a>
                                </div>
                                <label>Data przeprowadzenia badania</label>
                                <div class="form-group <?php echo $this->get('form_errors','date','class'); ?>">
                                    <input class="form-control" type="date" name="date" placeholder="Data rejestracji krzywej [rrrr-mm-dd]" value="<?php echo (isset($_POST['date'])) ? $_POST['date'] : date("Y-m-d"); ?>" required maxlength="255" />
                                    <a class="help-block"><?php echo $this->get('form_errors','date','error_msg'); ?></a>
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary" id="submit" value="Zarejestruj" style="float: right; margin-top: 50px;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>