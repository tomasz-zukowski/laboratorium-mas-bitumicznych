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
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-6">
                                    <i class="fa fa-link"></i> Edycja grupy użytkowników
                                </div>
                                <div class="col-sm-6 text-right">
                                    <?php
                                    if(Permissions::checkPermission('users_groups')) echo '<a href="/users/groups"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                                    if(Permissions::checkPermission('users_group_delete'))
                                    {
                                        if($this->get('group','id')!=0 && $this->get('group','id')!=1)
                                        {
                                            if(!empty($this->get('users')))
                                            {
                                                echo '<button class="btn btn-xs btn-danger popover-btn" data-container="body" data-toggle="popover" data-placement="right" data-content="Nie możesz usunąć grupy, do której przynależą użytkownicy!" data-trigger="focus"><i class="fa fa-trash-o"></i> usuń</button> ';
                                            }
                                            else
                                            {
                                                echo '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o"></i> usuń</button> ';
                                            }
                                        }
                                        else
                                        {
                                            echo '<button class="btn btn-xs btn-danger popover-btn" data-container="body" data-toggle="popover" data-placement="right" data-content="Nie możesz usunąć wbudowanych grup użytkowników!" data-trigger="focus"><i class="fa fa-trash-o"></i> usuń</button> ';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_this_path; ?>" method="POST">
                                <input type="hidden" name="id" value="<?php echo $this->get('group','id'); ?>" />
                                <label>Nazwa grupy</label>
                                <div class="form-group <?php echo $this->get('form_errors','name','class'); ?>">
                                    <input type="text" class="form-control" name="name" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : $this->get('group','type_name'); ?>" placeholder="Nazwa grupy" required />
                                </div>
                                <a class="help-block"><?php echo $this->get('form_errors','name','error_msg'); ?></a>

                                <label>Opis</label>
                                <div class="form-group <?php echo $this->get('form_errors','description','class'); ?>">
                                    <textarea class="form-control" name="description" placeholder="Opis grupy" rows="4"><?php echo (isset($_POST['description'])) ? $_POST['description'] : $this->get('group','description'); ?></textarea>
                                </div>
                                <a class="help-block"><?php echo $this->get('form_errors','description','error_msg'); ?></a>

                                <label>Dostępność</label>
                                <div class="form-group">
                                    <select name="active" class="form-control">
                                        <?php
                                        if($this->get('group','_active')==1)
                                            $on = 'selected';
                                        else
                                            $off = 'selected';
                                        echo '<option value="1" '.$on.'>Włączony \\ On</option>';
                                        echo '<option value="0" '.$off.'>Wyłączony \\ Off</option>';
                                        ?>
                                    </select>
                                </div>

                                <div style="width: 100%;" class="text-right">
                                    <br /><button class="btn btn-primary btn-sm" type="submit">Zapisz zmiany <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-group"></i> Użytkownicy przynależący do grupy</div>
                        <div class="panel-body">
                            <div style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-responsive table-hover">
                                <?php
                                if($users = $this->get('users'))
                                {
                                    $licznik = null;
                                    foreach($users as $user)
                                    {
                                        $licznik++;
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="/users/details/<?php echo $user['id']; ?>"><?php echo $user['surname'] . " " . $user['forename']; ?></a>
                                            </td>
                                            <td><?php echo $user['login']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <tr>
                                        <td class="text-center text-info" colspan="5">Brak zarejestrowanych użytkowników.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-check-square"></i> Uprawnienia grupy</div>
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
                                        <h3>Uprawnienia grup</h3>
                                        <p>Uprawnienia grupy są zestawem uprawnień przypisanym do danej grupy użytkowników. Domślnie po rejestracji grupy, uprawnienia te są wyzerowane.
                                           Istnieje możliwość dowolnej modyfikacji uprawnień.</p>
                                        <p>Uwaga: uprawnienia te znajdują się na pierwszym stopniu w hierarchi uprawnień aplikacji! Oznacza to, że użytkownicy przydzieleni do grupy dziedziczą jej uprawnienia, a uprawnienia użytkownika są pomijane!</p>
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