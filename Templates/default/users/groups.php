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
                                    <i class="fa fa-list"></i> Lista dostępnych grup użytkowników
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="/users/new_group"><button class="btn btn-xs btn-info"><i class="fa fa-plus"></i> nowa grupa</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;"><i class="fa fa-user"></i> Nazwa grupy</th>
                                        <th><i class="fa fa-envelope"></i> Opis grupy</th>
                                        <th style="width: 5%;">On/Off</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($groups = $this->get('groups'))
                                {
                                    $licznik = null;
                                    foreach($groups as $group)
                                    {
                                        $licznik++;
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="/users/edit_group/<?php echo $group['id']; ?>"><?php echo $group['type_name']; ?></a>
                                            </td>
                                            <td><?php echo $group['description']; ?></td>
                                            <td style="text-align: center;"><?php echo ($group['_active'] == 0) ? '<i class="fa fa-toggle-on"></i>' : '<i class="fa fa-toggle-off"></i>'; ?></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <tr>
                                        <td class="text-center text-info" colspan="5">Brak zarejestrowanych grup.</td>
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