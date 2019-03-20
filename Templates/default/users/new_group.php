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
                                    <i class="fa fa-link"></i> Rejestracja nowej grupy użytkowników
                                </div>
                                <div class="col-sm-6 text-right">
                                    <?php
                                    if(Permissions::checkPermission('users_groups')) echo '<a href="/users/groups"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_this_path; ?>" method="POST">
                                <label>Nazwa grupy</label>
                                <div class="form-group <?php echo $this->get('form_errors','name','class'); ?>">
                                    <input type="text" class="form-control" name="name" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ""; ?>" placeholder="Nazwa grupy" required />
                                </div>
                                <a class="help-block"><?php echo $this->get('form_errors','name','error_msg'); ?></a>

                                <label>Opis</label>
                                <div class="form-group <?php echo $this->get('form_errors','description','class'); ?>">
                                    <textarea class="form-control" name="description" placeholder="Opis grupy" rows="4"><?php echo (isset($_POST['description'])) ? $_POST['description'] : ""; ?></textarea>
                                </div>
                                <a class="help-block"><?php echo $this->get('form_errors','description','error_msg'); ?></a>

                                <label>Dostępność</label>
                                <div class="form-group">
                                    <select name="active" class="form-control">
                                        <option value="1">Włączony \ On</option>
                                        <option value="0">Wyłączony \ Off</option>
                                    </select>
                                </div>

                                <div style="width: 100%;" class="text-right">
                                    <br /><button class="btn btn-primary btn-sm" type="submit">Zarejestruj grupę <i class="fa fa-arrow-right"></i></button>
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