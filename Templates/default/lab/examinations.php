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
                        <div class="col-sm-6 form-inline">
                            <i class="fa fa-list"></i> Lista aktywnych zleceń badań
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_new_examination'))
                            {
                                echo '<a href="/lab/new_examination"><button class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Zleć badanie</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-calendar-o"></i> Termin badania</th>
                                <th style="width: 55%;"><i class="fa fa-user"></i> Klient</th>
                                <th style="width: 15%;"><i class="fa fa-cube"></i> Rodzaj badania</th>
                                <th style="width: 15%; text-align: center;">Próbka</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $_model = $this->get('model');

                            if($list = $this->get('list'))
                            {
                                for($i=0;$i<count($list);$i++)
                                {
                                    $client = $_model->getData("SELECT * FROM crm_clients_list WHERE id = '".$list[$i]['_client']."' LIMIT 1", true);
                                    echo "<tr>
                                            <td><a href='/lab/examination/".$list[$i]['id']."'>".$list[$i]['examination_date']."</a></td>
                                            <td>".$client['name']." - ".$client['str_type']." ".$client['street']." ".$client['number'].", ".$client['post_code']." ".$client['city']."</td>
                                            <td>".$list[$i]['symbol']."</td>";
                                    if($list[$i]['sample_status'] == 1)
                                    {
                                        echo "<td style='text-align: right;'><button class='btn btn-xs btn-success' style='width: 100px;'><i class='fa fa-check text-success' title='Próbka dostarczona'></i> Dostarczona</button></td>";
                                    }
                                    else
                                    {
                                        echo "<td style='text-align: right;'><button class='btn btn-xs btn-danger' style='width: 100px;'><i class='fa fa-ban'></i> Wprowadź</button></td>";
                                    }
                                    echo "</tr>";
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='4' class='text-center'>Brak aktywnych zleceń badań. Zleć <a href='/lab/new_examination'>nowe badanie</a>.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-right">
                    <a href="/lab/examinations_archive"><button class="btn btn-xs btn-default"><i class="fa fa-history"></i> Archiwum badań</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>