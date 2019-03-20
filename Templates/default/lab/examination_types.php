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
                            <i class="fa fa-cubes"></i> Lista aktywnych typów badań
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_new_examination_type'))
                            {
                                echo '<a href="/lab/new_type"><button class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Nowy typ badania</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-cube"></i> Symbol</th>
                                <th style="width: 17%;">Standard</th>
                                <th style="width: 30%;">Opis</th>
                                <th style="width: 12%;">Typ</th>
                                <th style="width: 12%;">Kategoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($list = $this->get('list'))
                            {
                                for($i=0;$i<count($list);$i++)
                                {
                                    echo "<tr>
                                            <td><a href='/lab/examination_type/".$list[$i]['id']."'>".$list[$i]['symbol']."</a></td>
                                            <td>".$list[$i]['standard_name']."</td>
                                            <td>".$list[$i]['standard_description']."</td>
                                            <td>".$list[$i]['standard_type']."</td>
                                            <td>".$list[$i]['standard_categorie']."</td>
                                        </tr>";
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
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>