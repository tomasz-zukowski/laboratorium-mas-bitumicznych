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
                            <i class="fa fa-plus"></i> Edycja klienta
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="/crm/client/<?php echo $this->get('id'); ?>"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="<?php echo $_this_path; ?>" method="POST">
                        <div class="row">
                            <div class="col-sm-7">
                                <table class="table table-responsive">
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Krótka nazwa</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','name','class'); ?>">
                                                <input class="form-control" type="text" name="name" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : $this->get('client_info','name'); ?>" placeholder="Krótka nazwa klienta" maxlength="100" required autofocus />
                                                <a class="help-block"><?php echo $this->get('form_errors','name','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Pełna nazwa</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','name2','class'); ?>">
                                                <input class="form-control" type="text" name="name2" value="<?php echo (isset($_POST['name2'])) ? $_POST['name2'] : $this->get('client_info','name2'); ?>" placeholder="Pełna nazwa klienta" maxlength="255" />
                                                <a class="help-block"><?php echo $this->get('form_errors','name2','error_msg'); ?></a>
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
                                                            if($this->get('client_info','str_type')==$str_type_list[$i]['value'])
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
                                                <input class="form-control" type="text" name="street" id="street" style="width: 50%;" value="<?php echo (isset($_POST['street'])) ? $_POST['street'] : $this->get('client_info','street'); ?>" placeholder="Nazwa ulicy" maxlength="100" required />
                                                <input class="form-control" type="text" name="number" id="number" style="width: 24%;" value="<?php echo (isset($_POST['number'])) ? $_POST['number'] : $this->get('client_info','number'); ?>" placeholder="Numer" maxlength="15" required />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','address','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Adres c.d.</td>
                                        <td>
                                            <div class="input-group form-inline <?php echo $this->get('form_errors','address2','class'); ?>">
                                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                                <input class="form-control" type="text" name="post_code" id="post_code" onchange="codeAddress()" style="width: 30%" value="<?php echo (isset($_POST['post_code'])) ? $_POST['post_code'] : $this->get('client_info','post_code'); ?>" placeholder="Kod pocztowy" maxlength="10" required />
                                                <input class="form-control" type="text" name="city" id="city" onchange="codeAddress()" style="width: 69%;" value="<?php echo (isset($_POST['city'])) ? $_POST['city'] : $this->get('client_info','city'); ?>" placeholder="Miejscowość" maxlength="100" required />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','address2','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Kraj</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','country','class'); ?>">
                                                <input class="form-control" type="text" name="country" value="<?php echo (isset($_POST['country'])) ? $_POST['country'] : $this->get('client_info','country'); ?>" placeholder="Kraj pochodzenia" maxlength="100" required />
                                                <a class="help-block"><?php echo $this->get('form_errors','country','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Numer NIP<br /><small>(bez separatorów)</small></td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','nip','class'); ?>">
                                                <input class="form-control" type="text" name="nip" value="<?php echo (isset($_POST['nip'])) ? $_POST['nip'] : $this->get('client_info','nip'); ?>" placeholder="Numer NIP" maxlength="10" />
                                                <a class="help-block"><?php echo $this->get('form_errors','nip','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">EU NIP<br /><small>(bez separatorów)</small></td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','eunip','class'); ?>">
                                                <input class="form-control" type="text" name="eunip" value="<?php echo (isset($_POST['eunip'])) ? $_POST['eunip'] : $this->get('client_info','eunip'); ?>" placeholder="Europejski numer NIP" maxlength="15" />
                                                <a class="help-block"><?php echo $this->get('form_errors','eunip','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Opis działalności</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','activity_description','class'); ?>">
                                                <textarea class="form-control" name="activity_description" placeholder="Opis działalności"><?php echo (isset($_POST['activity_description'])) ? $_POST['activity_description'] : $this->get('client_info','activity_description'); ?></textarea>
                                                <a class="help-block"><?php echo $this->get('form_errors','activity_description','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Status</td>
                                        <td>
                                            <div class="form-group">
                                                <select name="status" class="form-control">
                                                    <?php
                                                    if($this->get('client_info','_active')==1)
                                                        $on = 'selected';
                                                    else
                                                        $off = 'selected';
                                                    echo '<option value="1" '.$on.'>Aktywny \\ On</option>';
                                                    echo '<option value="0" '.$off.'>Niekatywny \\ Off</option>';
                                                    ?>
                                                </select>
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
                                <div id="map-canvas" class="img img-thumbnail" style="width: 100%; height: 450px;"></div>
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