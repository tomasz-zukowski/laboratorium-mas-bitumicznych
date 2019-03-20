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
                            <i class="fa fa-history"></i> Lista archiwalnych klientów
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('crm_review'))
                            {
                                echo '<a href="/crm/review"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%;"><i class="fa fa-user"></i> Nazwa</th>
                                <th><i class="fa fa-map-marker"></i> Adres</th>
                                <th style="width: 15%;">NIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($list = $this->get('list'))
                            {
                                for($i=0;$i<count($list);$i++)
                                {
                                    echo "<tr>
                                            <td><a href='/crm/client/".$list[$i]['id']."'>".$list[$i]['name']."</a></td>
                                            <td>".$list[$i]['str_type']." ".$list[$i]['street']." ".$list[$i]['number'].", ".$list[$i]['post_code']." ".$list[$i]['city']."</td>
                                            <td>".$list[$i]['nip']."</td>
                                          </tr>";
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='3' class='text-center'>Brak aktywnych klientów. Zarejestruj <a href='/crm/new_client'>nowego klienta</a>.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-right">
                    <?php
                    if($this->get('_pgn'))
                    {
                        echo $this->get('_pgn');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>