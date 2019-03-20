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
                            <i class="fa fa-cubes"></i> Lista aktywnych standardów
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_new_standard'))
                            {
                                echo '<a href="/lab/new_standard"><button class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Nowy standard</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%;"><i class="fa fa-cube"></i> Nazwa</th>
                                <th><i class="fa fa-file-o"></i> Dokument</th>
                                <th style="width: 15%;"><i class="fa fa-calendar-o"></i> Rok</th>
                                <th style="width: 10%; text-align: center;">Off/On</th>
                            </tr>
                        </thead>
                    </table>
                    <div style="max-height: 400px; overflow-y: auto; margin-top: -22px;">
                        <table class="table table-hover">
                            <tbody>
                                <?php
                                if($list = $this->get('list'))
                                {
                                    for($i=0;$i<count($list);$i++)
                                    {
                                        echo "<tr>
                                                <td style='width:30%;;'><a href='/lab/standard/".$list[$i]['id']."'>".$list[$i]['name']."</a></td>
                                                <td>".$list[$i]['document']."</td>
                                                <td style='width: 15%;'>".$list[$i]['year']."</td>";
                                        echo ($list[$i]['_active']==1) ? '<td class="text-center"><i class="fa fa-toggle-on"></i></td>' : '<td class="text-center"><i class="fa fa-toggle-off"></i></td>';
                                        echo "</tr>";
                                    }
                                }
                                else
                                {
                                    echo "<tr><td colspan='3' class='text-center'>Brak zarejestrowanych standardów.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>