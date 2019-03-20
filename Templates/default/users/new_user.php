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
                                    <i class="fa fa-user"></i> Nowy użytkownik
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="/users/manage"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="well well-sm" id="info">
                                <form action="<?php echo $_this_path; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <img src="/Templates/<?php echo $_SESSION['layout']; ?>/images/male.gif" class="thumbnail" style="width: 100%;">
                                        </div>
                                        <div class="col-sm-10">
                                            <table class="table table-responsive">
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Nazwisko</td>
                                                    <td>
                                                        <div class="form-group <?php echo $this->get('form_errors','surname','class'); ?>">
                                                            <input class="form-control" type="text" name="surname" value="<?php echo (isset($_POST['surname'])) ? $_POST['surname'] : ""; ?>" placeholder="Nazwisko użytkownika" required autofocus />
                                                            <a class="help-block"><?php echo $this->get('form_errors','surname','error_msg'); ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Imię</td>
                                                    <td>
                                                        <div class="form-group <?php echo $this->get('form_errors','forename','class'); ?>">
                                                            <input class="form-control" type="text" name="forename" value="<?php echo (isset($_POST['forename'])) ? $_POST['forename'] : ""; ?>" placeholder="Imię użytkownika" required />
                                                            <a class="help-block"><?php echo $this->get('form_errors','forename','error_msg'); ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Login</td>
                                                    <td>
                                                        <div class="input-group <?php echo $this->get('form_errors','login','class'); ?>">
                                                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                            <input class="form-control" type="text" name="login" value="<?php echo (isset($_POST['login'])) ? $_POST['login'] : ""; ?>" placeholder="Login użytkownika" required />
                                                        </div>
                                                        <a class="help-block"><?php echo $this->get('form_errors','login','error_msg'); ?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Hasło</td>
                                                    <td>
                                                        <div class="input-group form-inline <?php echo $this->get('form_errors','password','class'); ?>">
                                                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                                            <input class="form-control" type="password" name="password" style="width: 49%;" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : ""; ?>" placeholder="Podaj hasło" required />
                                                            <input class="form-control" type="password" name="password_2" style="width: 50%;" value="<?php echo (isset($_POST['password_2'])) ? $_POST['password_2'] : ""; ?>" placeholder="Powtórz hasło" required />
                                                        </div>
                                                        <a class="help-block"><?php echo $this->get('form_errors','password','error_msg'); ?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Adres e-mail</td>
                                                    <td>
                                                        <div class="input-group margin-bottom-sm <?php echo $this->get('form_errors','email','class'); ?>">
                                                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                                            <input class="form-control" type="email" name="email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ""; ?>" placeholder="Adres mailowy" />
                                                        </div>
                                                        <a class="help-block"><?php echo $this->get('form_errors','email','error_msg'); ?></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%; font-weight: bold;">Grupa</td>
                                                    <td>
                                                        <div class="form-group <?php echo $this->get('form_errors','group','class'); ?>">
                                                            <select class="form-control" name="group">
                                                                <?php
                                                                foreach($this->get('groups') as $group)
                                                                {
                                                                    echo "<option value='".$group['id']."'>".$group['type_name']."</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            <a class="help-block"><?php echo $this->get('form_errors','group','error_msg'); ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <button class="btn btn-primary btn-sm" type="submit">Zarejestruj <i class="fa fa-arrow-right"></i></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer text-right"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>