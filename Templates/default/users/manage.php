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
                                    <i class="fa fa-list"></i> Lista użytkowników
                                </div>
                                <div class="col-sm-6 text-right">
                                    <?php
                                    if(Permissions::checkPermission('users_new_one'))
                                    {
                                        echo '<a href="/users/new_user"><button class="btn btn-xs btn-info"><i class="fa fa-user-plus"></i> nowy użytkownik</button></a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;"><i class="fa fa-user"></i> Nazwisko i imię</th>
                                        <th><i class="fa fa-envelope"></i> Adres e-mail</th>
                                        <th style="width: 20%;">Login</th>
                                        <th style="width: 10%;"><li class="fa fa-group"></li> Grupa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($users = $this->get('users_info'))
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
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['login']; ?></td>
                                            <td><?php echo $user['group_name']; ?></td>
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
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer text-right">
                            <?php
                            echo $this->get('_pgn');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>