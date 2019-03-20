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
                            <i class="fa fa-list"></i> Lista badań z dniu <?php echo $this->get("year")."-".$this->get("month")."-".$this->get("day"); ?>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_schedule_month'))
                            {
                                echo '<a href="/lab/schedule_month/'.$this->get('year').'/'.$this->get('month').'"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <h4>Lista przeprowadzonych badań</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-calendar-o"></i> Termin badania</th>
                                <th style="width: 55%;"><i class="fa fa-user"></i> Klient</th>
                                <th style="width: 15%;"><i class="fa fa-cube"></i> Rodzaj badania</th>
                                <th style="width: 15%;">Data badania</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $_model = $this->get('model');

                            if($examination_dates = $this->get('examination_dates'))
                            {
                                for($i=0;$i<count($examination_dates);$i++)
                                {
                                    $client = $_model->getData("SELECT * FROM crm_clients_list WHERE id = '".$examination_dates[$i]['_client']."' LIMIT 1", true);
                                    echo "<tr>
                                            <td><a href='/lab/examination/".$examination_dates[$i]['id']."'>".$examination_dates[$i]['examination_date']."</a></td>
                                            <td>".$client['name']." - ".$client['str_type']." ".$client['street']." ".$client['number'].", ".$client['post_code']." ".$client['city']."</td>
                                            <td>".$examination_dates[$i]['symbol']."</td>
                                            <td>".$examination_dates[$i]['status_changed_date']." ".$examination_dates[$i]['status_changed_time']."</td>
                                          </tr>";
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='4' class='text-center'>Brak przeprowadzonych badań w wybranym terminie.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <hr />
                    <h4>Lista badań do przeprowadzenia</h4>
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
                        if($examination_terms = $this->get('examination_terms'))
                        {
                            for($i=0;$i<count($examination_terms);$i++)
                            {
                                $client = $_model->getData("SELECT * FROM crm_clients_list WHERE id = '".$examination_terms[$i]['_client']."' LIMIT 1", true);
                                echo "<tr>
                                            <td><a href='/lab/examination/".$examination_terms[$i]['id']."'>".$examination_terms[$i]['examination_date']."</a></td>
                                            <td>".$client['name']." - ".$client['str_type']." ".$client['street']." ".$client['number'].", ".$client['post_code']." ".$client['city']."</td>
                                            <td>".$examination_terms[$i]['symbol']."</td>";
                                if($examination_terms[$i]['sample_status'] == 1)
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
                            echo "<tr><td colspan='4' class='text-center'>Brak badań z wybranym terminem.</td></tr>";
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