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
                            <i class="fa fa-cube"></i> Dopuszczalne odchyłki badań dla standardu <a><?php echo $this->get('standard','name'); ?></a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_standard_details'))
                            {
                                echo '<a href="/lab/standard/'.$this->get('standard','id').'"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrot</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?php echo $_this_path; ?>">
                        <?php
                        $deviations = $this->get('deviations');
                        ?>
                        <table class="table">
                            <thead>
                                <th colspan="3">Dopuszczalne odchyłki badań</th>
                            </thead>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S45l','class'); ?>">
                                        <input class="form-control" type="text" name="S45l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S45l'])) ? $_POST['S45l'] : $deviations['S45l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S45l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 45,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S45r','class'); ?>">
                                        <input class="form-control" type="text" name="S45r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S45r'])) ? $_POST['S45r'] : $deviations['S45r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S45r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S31l','class'); ?>">
                                        <input class="form-control" type="text" name="S31l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S31l'])) ? $_POST['S31l'] : $deviations['S31l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S31l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 31,500 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S31r','class'); ?>">
                                        <input class="form-control" type="text" name="S31r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S31r'])) ? $_POST['S31r'] : $deviations['S31r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S31r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S22l','class'); ?>">
                                        <input class="form-control" type="text" name="S22l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S22l'])) ? $_POST['S22l'] : $deviations['S22l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S22l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 22,400 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S22r','class'); ?>">
                                        <input class="form-control" type="text" name="S22r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S22r'])) ? $_POST['S22r'] : $deviations['S22r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S22r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S16l','class'); ?>">
                                        <input class="form-control" type="text" name="S16l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S16l'])) ? $_POST['S16l'] : $deviations['S16l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S16l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 16,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S16r','class'); ?>">
                                        <input class="form-control" type="text" name="S16r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S16r'])) ? $_POST['S16r'] : $deviations['S16r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S16r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S11l','class'); ?>">
                                        <input class="form-control" type="text" name="S11l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S11l'])) ? $_POST['S11l'] : $deviations['S11l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S11l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 11,200 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S11r','class'); ?>">
                                        <input class="form-control" type="text" name="S11r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S11r'])) ? $_POST['S11r'] : $deviations['S11r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S11r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S8l','class'); ?>">
                                        <input class="form-control" type="text" name="S8l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S8l'])) ? $_POST['S8l'] : $deviations['S8l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S8l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 8,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S8r','class'); ?>">
                                        <input class="form-control" type="text" name="S8r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S8r'])) ? $_POST['S8r'] : $deviations['S8r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S8r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S5l','class'); ?>">
                                        <input class="form-control" type="text" name="S5l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S5l'])) ? $_POST['S5l'] : $deviations['S5l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S5l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 5,600 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S5r','class'); ?>">
                                        <input class="form-control" type="text" name="S5r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S5r'])) ? $_POST['S5r'] : $deviations['S5r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S5r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S4l','class'); ?>">
                                        <input class="form-control" type="text" name="S4l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S4l'])) ? $_POST['S4l'] : $deviations['S4l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S4l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 4,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S4r','class'); ?>">
                                        <input class="form-control" type="text" name="S4r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S4r'])) ? $_POST['S4r'] : $deviations['S4r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S4r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S2l','class'); ?>">
                                        <input class="form-control" type="text" name="S2l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S2l'])) ? $_POST['S2l'] : $deviations['S2l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S2l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 2,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S2r','class'); ?>">
                                        <input class="form-control" type="text" name="S2r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S2r'])) ? $_POST['S2r'] : $deviations['S2r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S2r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S125l','class'); ?>">
                                        <input class="form-control" type="text" name="S125l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S125l'])) ? $_POST['S125l'] : $deviations['S125l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S125l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 0,125 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S125r','class'); ?>">
                                        <input class="form-control" type="text" name="S125r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S125r'])) ? $_POST['S125r'] : $deviations['S125r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S125r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S063l','class'); ?>">
                                        <input class="form-control" type="text" name="S063l" placeholder="Odchyłka od" value="<?php echo (isset($_POST['S063l'])) ? $_POST['S063l'] : $deviations['S063l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S063l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 0,063 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S063r','class'); ?>">
                                        <input class="form-control" type="text" name="S063r" placeholder="Odchyłka do" value="<?php echo (isset($_POST['S063r'])) ? $_POST['S063r'] : $deviations['S063r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S063r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','bituml','class'); ?>">
                                        <input class="form-control" type="text" name="bituml" placeholder="Odchyłka od" value="<?php echo (isset($_POST['bituml'])) ? $_POST['bituml'] : $deviations['bituml']; ?>" required maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','bituml','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Zawartość asfaltu</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','bitumr','class'); ?>">
                                        <input class="form-control" type="text" name="bitumr" placeholder="Odchyłka do" value="<?php echo (isset($_POST['bitumr'])) ? $_POST['bitumr'] : $deviations['bitumr']; ?>" required maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','bitumr','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;" colspan="3"><input type="submit" class="btn btn-primary btn-sm" value="Zapisz odchyłki" /></td>
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