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
                                    <i class="fa fa-user"></i> Użytkownik <a><?php echo $this->get('surname').' '. $this->get('forename'); ?></a>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <?php
                                    if(Permissions::checkPermission('users_manage')) echo '<a href="/users/manage"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                                    if(Permissions::checkPermission('users_edit')) echo '<a href="/users/edit_user/'.$this->get('id').'"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> edytuj</button></a> ';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="well well-sm" id="info">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="/Templates/<?php echo $_SESSION['layout']; ?>/images/male.gif" class="thumbnail" style="width: 100%;">
                                    </div>
                                    <div class="col-sm-10">
                                        <table class="table table-responsive">
                                            <tr>
                                                <td style="width: 20%; font-weight: bold;">Nazwisko</td>
                                                <td><?php echo $this->get('surname'); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; font-weight: bold;">Imię</td>
                                                <td><?php echo $this->get('forename'); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; font-weight: bold;">Adres e-mail</td>
                                                <td><a><i class="fa fa-envelope-o"></i> <?php echo $this->get('email'); ?></a></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; font-weight: bold;">Login</td>
                                                <td><?php echo $this->get('login'); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; font-weight: bold;">Grupa</td>
                                                <td><?php echo $this->get('group'); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>