<!DOCTYPE html>
<html>
    <head>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/header.php'; ?>
    </head>
    <body>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/main_nav_bar_unlogged.php'; ?>
        <div class="container">
            <?php include 'Templates/'.$_SESSION['layout'].'/Const/alerts.php'; ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-cogs"></i> Instalator aplikacji</div>
                        <div class="panel-body">
                            <?php
                            if(!empty($_POST))
                            {
                                echo '<div id="results" style="max-height: 400px; overflow-y: auto;">';
                                $this->Model->installApp($_POST);
                                echo '</div>';
                            }
                            else
                            {
                                include 'Conf/database_mysql.php';
                                echo "<h3><i class='fa fa-gear'></i> Sprawdź ustawienia bazy danych</h3>";
                                echo "<h5>Upewnij się, czy użytkownik bazy danych jest skonfigurowany wg poniższych ustawień (Uwaga: użytkownik <u>musi</u> posiadać uprawnienia administratora).</h5>";
                                echo "<table class='table table-bordered'>";
                                echo "<tr>
                                            <td style='width: 30%;'><label>Użytkownik bazy danych</label></td>
                                            <td><input type='text' class='form-control' value='".$settings['user']."' /></td>
                                        </tr>";
                                echo "<tr>
                                            <td><label>Hasło użytkownika</label> <small>(wskaż aby pokazać)</small></td>
                                            <td><input type='password' id='pass' class='form-control' value='".$settings['pass']."' /></td>
                                        </tr>";
                                echo "</table>";
                                echo "<h3><i class='fa fa-user-secret'></i> Wprowadź dane konta administratora</h3>";
                                echo "<h5>Podane poniżej dane posłużą do utworzenia konta administratora systemu. Należy je zapamiętać!</h5>";
                                echo "<form action='".$_this_path."' method='POST'>";
                                echo "<table class='table table-bordered'>";
                                ?>
                                <tr>
                                    <td style="width: 20%; font-weight: bold;">Nazwisko</td>
                                    <td>
                                        <div class="form-group <?php echo $this->get('form_errors','surname','class'); ?>">
                                            <input class="form-control" type="text" name="surname" value="<?php echo (isset($_POST['surname'])) ? $_POST['surname'] : ""; ?>" placeholder="Nazwisko użytkownika" required autofocus />
                                            <input class="form-control" type="hidden" name="group" value="1" />
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
                                            <input class="form-control" type="email" name="email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ""; ?>" placeholder="Adres mailowy" required />
                                        </div>
                                        <a class="help-block"><?php echo $this->get('form_errors','email','error_msg'); ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; font-weight: bold;">Klucz instalacyjny</td>
                                    <td>
                                        <div class="input-group margin-bottom-sm <?php echo $this->get('form_errors','key','class'); ?>">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                            <input class="form-control" type="number" name="key" value="<?php echo (isset($_POST['key'])) ? $_POST['key'] : ""; ?>" placeholder="Klucz instalacyjny" required />
                                        </div>
                                        <a class="help-block"><?php echo $this->get('form_errors','key','error_msg'); ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right">
                                        <button class="btn btn-primary btn-sm" type="submit">Rozpocznij instalację <i class="fa fa-arrow-right"></i></button>
                                    </td>
                                </tr>
                                <?php
                                echo "</table>";
                                echo "</form>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>