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
                            <i class="fa fa-cube"></i> Wartości krzywych granicznych dla <a><?php echo $this->get('type','type')." ".$this->get('categorie','categorie'); ?></a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_standard_details'))
                            {
                                echo '<a href="/lab/standard/'.$this->get('type','standard').'"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrot</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?php echo $_this_path; ?>">
                        <?php
                        $borders = $this->get('borders');
                        ?>
                        <table class="table">
                            <thead>
                                <th colspan="3">Wartości krzywych granicznych</th>
                            </thead>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S45l','class'); ?>">
                                        <input class="form-control" type="text" name="S45l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S45l'])) ? $_POST['S45l'] : $borders['S45l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S45l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 45,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S45r','class'); ?>">
                                        <input class="form-control" type="text" name="S45r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S45r'])) ? $_POST['S45r'] : $borders['S45r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S45r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S31l','class'); ?>">
                                        <input class="form-control" type="text" name="S31l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S31l'])) ? $_POST['S31l'] : $borders['S31l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S31l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 31,500 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S31r','class'); ?>">
                                        <input class="form-control" type="text" name="S31r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S31r'])) ? $_POST['S31r'] : $borders['S31r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S31r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S22l','class'); ?>">
                                        <input class="form-control" type="text" name="S22l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S22l'])) ? $_POST['S22l'] : $borders['S22l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S22l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 22,400 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S22r','class'); ?>">
                                        <input class="form-control" type="text" name="S22r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S22r'])) ? $_POST['S22r'] : $borders['S22r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S22r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S16l','class'); ?>">
                                        <input class="form-control" type="text" name="S16l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S16l'])) ? $_POST['S16l'] : $borders['S16l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S16l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 16,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S16r','class'); ?>">
                                        <input class="form-control" type="text" name="S16r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S16r'])) ? $_POST['S16r'] : $borders['S16r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S16r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S11l','class'); ?>">
                                        <input class="form-control" type="text" name="S11l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S11l'])) ? $_POST['S11l'] : $borders['S11l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S11l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 11,200 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S11r','class'); ?>">
                                        <input class="form-control" type="text" name="S11r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S11r'])) ? $_POST['S11r'] : $borders['S11r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S11r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S8l','class'); ?>">
                                        <input class="form-control" type="text" name="S8l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S8l'])) ? $_POST['S8l'] : $borders['S8l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S8l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 8,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S8r','class'); ?>">
                                        <input class="form-control" type="text" name="S8r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S8r'])) ? $_POST['S8r'] : $borders['S8r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S8r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S5l','class'); ?>">
                                        <input class="form-control" type="text" name="S5l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S5l'])) ? $_POST['S5l'] : $borders['S5l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S5l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 5,600 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S5r','class'); ?>">
                                        <input class="form-control" type="text" name="S5r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S5r'])) ? $_POST['S5r'] : $borders['S5r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S5r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S4l','class'); ?>">
                                        <input class="form-control" type="text" name="S4l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S4l'])) ? $_POST['S4l'] : $borders['S4l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S4l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 4,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S4r','class'); ?>">
                                        <input class="form-control" type="text" name="S4r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S4r'])) ? $_POST['S4r'] : $borders['S4r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S4r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S2l','class'); ?>">
                                        <input class="form-control" type="text" name="S2l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S2l'])) ? $_POST['S2l'] : $borders['S2l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S2l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 2,000 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S2r','class'); ?>">
                                        <input class="form-control" type="text" name="S2r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S2r'])) ? $_POST['S2r'] : $borders['S2r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S2r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S125l','class'); ?>">
                                        <input class="form-control" type="text" name="S125l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S125l'])) ? $_POST['S125l'] : $borders['S125l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S125l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 0,125 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S125r','class'); ?>">
                                        <input class="form-control" type="text" name="S125r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S125r'])) ? $_POST['S125r'] : $borders['S125r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S125r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','S063l','class'); ?>">
                                        <input class="form-control" type="text" name="S063l" placeholder="Lewa granica" value="<?php echo (isset($_POST['S063l'])) ? $_POST['S063l'] : $borders['S063l']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S063l','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Sito 0,063 mm</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','S063r','class'); ?>">
                                        <input class="form-control" type="text" name="S063r" placeholder="Prawa granica" value="<?php echo (isset($_POST['S063r'])) ? $_POST['S063r'] : $borders['S063r']; ?>" maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','S063r','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="form-group <?php echo $this->get('form_errors','bituml','class'); ?>">
                                        <input class="form-control" type="text" name="bituml" placeholder="Lewa granica" value="<?php echo (isset($_POST['bituml'])) ? $_POST['bituml'] : $borders['bituml']; ?>" required maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','bituml','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><label>Zawartość asfaltu</label></td>
                                <td style="width: 25%;">
                                    <div class="form-group <?php echo $this->get('form_errors','bitumr','class'); ?>">
                                        <input class="form-control" type="text" name="bitumr" placeholder="Prawa granica" value="<?php echo (isset($_POST['bitumr'])) ? $_POST['bitumr'] : $borders['bitumr']; ?>" required maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','bitumr','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;" colspan="3"><input type="submit" class="btn btn-primary btn-sm" value="Zapisz wartości" /></td>
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