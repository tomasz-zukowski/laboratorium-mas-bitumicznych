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
                            <i class="fa fa-cube"></i> Rejestracja nowego typu badania
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_examination_types'))
                            {
                                echo '<a href="/lab/examination_types"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> lista typów</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/lab/new_type">
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                $standards = $this->get('standards');
                                ?>
                                <label>Symbol typu badania</label>
                                <div class="form-group <?php echo $this->get('form_errors','symbol','class'); ?>">
                                    <input class="form-control" type="text" name="symbol" placeholder="Symbol badania" value="<?php echo (isset($_POST['symbol'])) ? $_POST['symbol'] : ""; ?>" required maxlength="255" />
                                    <a class="help-block"><?php echo $this->get('form_errors','symbol','error_msg'); ?></a>
                                </div>

                                <label>Standard badania</label>
                                <div class="form-group <?php echo $this->get('form_errors','standard','class'); ?>">
                                    <select id="standard" name="standard" class="form-control" required>
                                        <option value="0">Wybierz</option>
                                        <?php
                                        for($i=0;$i<count($standards);$i++)
                                        {
                                            echo "<option value='".$standards[$i]['id']."'>".$standards[$i]['name']."</option>";
                                        }
                                        ?>
                                    </select>
                                    <a class="help-block"><?php echo $this->get('form_errors','standard','error_msg'); ?></a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Opis</label>
                                <div class="form-group <?php echo $this->get('form_errors','description','class'); ?>">
                                    <select id="description" name="description" class="form-control" required>
                                        <option value="0">Wybierz standard</option>
                                        <?php
                                        for($i=0;$i<count($descriptions);$i++)
                                        {
                                            echo "<option value='".$descriptions[$i]['id']."'>".$descriptions[$i]['description']."</option>";
                                        }
                                        ?>
                                    </select>
                                    <a class="help-block"><?php echo $this->get('form_errors','description','error_msg'); ?></a>
                                </div>

                                <label>Typ</label>
                                <div class="form-group <?php echo $this->get('form_errors','type','class'); ?>">
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="0">Wybierz standard</option>
                                        <?php
                                        for($i=0;$i<count($types);$i++)
                                        {
                                            echo "<option value='".$types[$i]['id']."'>".$types[$i]['type']."</option>";
                                        }
                                        ?>
                                    </select>
                                    <a class="help-block"><?php echo $this->get('form_errors','type','error_msg'); ?></a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Kategoria natężenia ruchu</label>
                                <div class="form-group <?php echo $this->get('form_errors','categorie','class'); ?>">
                                    <select id="categorie" name="categorie" class="form-control" required>
                                        <option value="0">Wybierz standard</option>
                                        <?php
                                        for($i=0;$i<count($categories);$i++)
                                        {
                                            echo "<option value='".$categories[$i]['id']."'>".$categories[$i]['categorie']."</option>";
                                        }
                                        ?>
                                    </select>
                                    <a class="help-block"><?php echo $this->get('form_errors','categorie','error_msg'); ?></a>
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary disabled" id="submit" value="Zarejestruj" style="float: right; margin-top: 50px;" />
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