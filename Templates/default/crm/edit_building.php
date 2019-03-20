<!DOCTYPE html>
<html>
<head>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
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
                            <i class="fa fa-plus"></i> Edycja budowy
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="/crm/client/<?php echo $this->get('client_id'); ?>"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a>
                            <?php
                            if(Permissions::checkPermission('crm_delete_build'))
                            {
                                echo '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> usuń</button> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="<?php echo $_this_path; ?>" method="POST">
                        <div class="row">
                            <div class="col-sm-7">
                                <table class="table table-responsive">
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Nazwa</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','name','class'); ?>">
                                                <input class="form-control" type="text" name="name" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : $this->get('building','name'); ?>" placeholder="Nazwa budowy" maxlength="100" required autofocus />
                                                <a class="help-block"><?php echo $this->get('form_errors','name','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Adres</td>
                                        <td>
                                            <div class="input-group form-inline <?php echo $this->get('form_errors','address','class'); ?>">
                                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                                <select class="form-control" name="str_type" style="width: 25%;" required>
                                                    <?php
                                                    $str_type_list = $this->get('str_type_list');
                                                    for($i=0;$i<count($str_type_list);$i++)
                                                    {
                                                        if(isset($_POST['str_type']))
                                                        {
                                                            if($_POST['str_type']==$str_type_list[$i]['value'])
                                                            {
                                                                echo "<option value='".$str_type_list[$i]['value']."' selected='selected'>".$str_type_list[$i]['name']."</option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='".$str_type_list[$i]['value']."'>".$str_type_list[$i]['name']."</option>";
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if($this->get('building','str_type')==$str_type_list[$i]['value'])
                                                            {
                                                                echo "<option value='".$str_type_list[$i]['value']."' selected='selected'>".$str_type_list[$i]['name']."</option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='".$str_type_list[$i]['value']."'>".$str_type_list[$i]['name']."</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input class="form-control" type="text" name="street" id="street" style="width: 50%;" value="<?php echo (isset($_POST['street'])) ? $_POST['street'] : $this->get('building','street'); ?>" placeholder="Nazwa ulicy" maxlength="100" required />
                                                <input class="form-control" type="text" name="number" id="number" style="width: 24%;" value="<?php echo (isset($_POST['number'])) ? $_POST['number'] : $this->get('building','number'); ?>" placeholder="Numer" maxlength="15" required />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','address','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Adres c.d.</td>
                                        <td>
                                            <div class="input-group form-inline <?php echo $this->get('form_errors','address2','class'); ?>">
                                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                                <input class="form-control" type="text" name="post_code" id="post_code" onchange="codeAddress()" style="width: 30%" value="<?php echo (isset($_POST['post_code'])) ? $_POST['post_code'] : $this->get('building','post_code'); ?>" placeholder="Kod pocztowy" maxlength="10" required />
                                                <input class="form-control" type="text" name="city" id="city" onchange="codeAddress()" style="width: 69%;" value="<?php echo (isset($_POST['city'])) ? $_POST['city'] : $this->get('building','city'); ?>" placeholder="Miejscowość" maxlength="100" required />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','address2','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Uwagi</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','comments','class'); ?>">
                                                <textarea class="form-control" name="comments" placeholder="Uwagi dotyczące budowy"><?php echo (isset($_POST['comments'])) ? $_POST['comments'] : $this->get('building','comments'); ?></textarea>
                                                <a class="help-block"><?php echo $this->get('form_errors','comments','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">
                                            <button class="btn btn-success btn-sm" id="check_location" type="button" onclick="codeAddress()">Sprawdź lokalizację <i class="fa fa-map-marker"></i></button>
                                            <button class="btn btn-primary btn-sm" type="submit">Zapisz zmiany <i class="fa fa-save"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-5">
                                <div id="map-canvas" class="img img-thumbnail" style="width: 100%; height: 300px;"></div>
                                <h4 id="status"></h4>
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