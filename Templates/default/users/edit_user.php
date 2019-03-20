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
                                    <i class="fa fa-info"></i> Podstawowe informacje
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="/users/details/<?php echo $this->get('id'); ?>"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a>
                                    <?php
                                    if(Permissions::checkPermission('users_delete'))
                                    {
                                        if($this->get('group')==1)
                                        {
                                            echo '<button class="btn btn-xs btn-danger popover-btn" data-container="body" data-toggle="popover" data-placement="right" data-content="Nie możesz usunąć użytkownika należącego do grupy administratorzy!" data-trigger="focus"><i class="fa fa-trash-o"></i> usuń</button> ';
                                        }
                                        else
                                        {
                                            echo '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-user-times"></i> usuń</button> ';
                                        }
                                    }
                                    ?>
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
                                                <tr>
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
                                <?php
                                /*if(Permissions::checkModule('extended_users'))
                                {
                                */?><!--
                                    <div class="alert alert-info alert-dismissable text-center">
                                        <button class="close" data-dismiss="alert" aria-hidden="true" type="button">&times;</button>
                                    </div>
                                    //include('Templates/'.$_SESSION['layout'].'/extended_users/edit.php');
                                --><?php
/*                                }
                                else
                                {
                                    if(Permissions::checkPermission(true))
                                    {
                                        echo '<div class="alert alert-info alert-dismissable text-center">
                                                  <button class="close" data-dismiss="alert" aria-hidden="true" type="button">&times;</button>';
                                        echo '    Aby korzystać z opcji rozszerzonych należy zainstalować moduł <b>extended_users</b>.';
                                        echo '</div>';
                                    }
                                }*/
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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

                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-group"></i> Zmiana grupy</div>
                        <div class="panel-body">
                            <form action="<?php echo $_this_path; ?>" method="POST" name="grupy">
                                <table class="table table-responsive">
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Grupa</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','group','class'); ?>">
                                                <select class="form-control" name="group">
                                                    <?php
                                                    foreach($this->get('groups') as $group)
                                                    {
                                                        if($group['id']==$_POST['group'] || $group['id']==$this->get('group'))
                                                        {
                                                            echo "<option selected value='".$group['id']."'>".$group['type_name']."</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='".$group['id']."'>".$group['type_name']."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <a class="help-block"><?php echo $this->get('form_errors','group','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">
                                            <button class="btn btn-primary btn-sm" type="submit">Zmień grupę <i class="fa fa-save"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-check-square"></i> Uprawnienia użytkownika</div>
                        <div class="panel-body">
                            <form action="<?php echo $_this_path ?>" method="POST">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <?php
                                        if(Permissions::checkModule('rights'))
                                        {
                                            echo '<div class="well">
                                                        <div style="max-height: 490px; overflow-y: auto;">';
                                            if($this->get('rights_tree'))
                                            {
                                                foreach($this->get('rights_tree') as $file)
                                                {
                                                    include_once($file);
                                                }
                                            }
                                            echo '</div>
                                                        <div class="text-right" style="padding-top: 10px;">
                                                            <button type="submit" name="save" class="btn btn-primary btn-sm" value="Zapisz">Zapisz zmiany <i class="fa fa-floppy-o"></i></button>
                                                        </div>
                                                    </div>';
                                        }
                                        else
                                        {
                                            echo '<div class="alert alert-info alert-dismissable text-center">
                                                          <button class="close" data-dismiss="alert" aria-hidden="true" type="button">&times;</button>';
                                            echo '    Aby korzystać z opcji rozszerzonych należy zainstalować moduł <b>rights</b>.';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <h3>Uprawnienia użytkownika</h3>
                                        <p>Uprawnienia użytkownika są zestawem uprawnień przypisanym do konkretnego użytkownika. Domyślnie po instalacji użytkownikowi zostają przypisane uprawnienia z zestawu uprawnień domyślnych.
                                           Istnieje możliwość dowolnej modyfikacji uprawnień.</p>
                                        <p>Uwaga: uprawnienia te znajdują się na drugim stopniu w hierarchi uprawnień aplikacji! W pierwszej kolejności w przypadku przynależności użytkownika do grupy pobierane są uprawnienia grup!</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>