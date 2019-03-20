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
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-12">
                                    <i class="fa fa-info"></i> Podstawowe informacje
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="info">
                                <form action="<?php echo $_this_path; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-responsive">
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Nazwisko</td>
                                                    <td>
                                                        <div class="form-group <?php echo $this->get('form_errors','surname','class'); ?>">
                                                            <input class="form-control" type="text" name="surname" value="<?php echo (isset($_POST['surname'])) ? $_POST['surname'] : $this->get('surname'); ?>" required />
                                                            <a class="help-block"><?php echo $this->get('form_errors','surname','error_msg'); ?></a>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Imię</td>
                                                    <td>
                                                        <div class="form-group <?php echo $this->get('form_errors','forename','class'); ?>">
                                                            <input class="form-control" type="text" name="forename" value="<?php echo (isset($_POST['forename'])) ? $_POST['forename'] : $this->get('forename'); ?>" required autofocus />
                                                            <a class="help-block"><?php echo $this->get('form_errors','forename','error_msg'); ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td style="width: 20%; font-weight: bold;">Login</td>
                                                    <td>
                                                        <div class="input-group <?php echo $this->get('form_errors','login','class'); ?>">
                                                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                            <input class="form-control" type="text" name="login" value="<?php echo (isset($_POST['login'])) ? $_POST['login'] : $this->get('login'); ?>" required />
                                                        </div>
                                                        <a class="help-block"><?php echo $this->get('form_errors','login','error_msg'); ?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Adres e-mail</td>
                                                    <td>
                                                        <div class="input-group margin-bottom-sm <?php echo $this->get('form_errors','email','class'); ?>">
                                                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                                            <input class="form-control" type="email" name="email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : $this->get('email'); ?>" />
                                                        </div>
                                                        <a class="help-block"><?php echo $this->get('form_errors','email','error_msg'); ?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <button class="btn btn-primary btn-sm" type="submit">Zapisz zmiany <i class="fa fa-save"></i></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-key"></i> Zmiana hasła</div>
                        <div class="panel-body">
                            <form action="<?php echo $_this_path; ?>" method="POST">
                                <table class="table table-responsive">
                                    <tr>
                                        <td style="width: 25%; font-weight: bold;">Hasło</td>
                                        <td>
                                            <div class="input-group <?php echo $this->get('form_errors','old_password','class'); ?>">
                                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                                <input class="form-control" type="password" name="old_password" placeholder="Aktualne hasło" required />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','old_password','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%; font-weight: bold;">Nowe hasło</td>
                                        <td>
                                            <div class="input-group form-inline <?php echo $this->get('form_errors','new_password','class'); ?>">
                                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                                <input class="form-control" type="password" name="new_password" style="width: 49%;" placeholder="Podaj hasło" required />
                                                <input class="form-control" type="password" name="new_password_2" style="width: 50%;" placeholder="Powtórz hasło" required />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','new_password','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">
                                            <button class="btn btn-primary btn-sm" type="submit">Zmień hasło <i class="fa fa-save"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>