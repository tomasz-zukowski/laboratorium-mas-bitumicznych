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
                            <i class="fa fa-list"></i> Lista świadectw badań
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Próbka</th>
                                <th><i class="fa fa-calendar-o"></i> Data badania</th>
                                <th style="width: 45%;"><i class="fa fa-user"></i> Klient</th>
                                <th style="width: 15%;"><i class="fa fa-cube"></i> Rodzaj badania</th>
                                <th><i class="fa fa-certificate"></i> Świadectwo</th>
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
                                            <td><a href='/lab/examination/".$list[$i]['id']."'>".$list[$i]['sample_number']."</a></td>
                                            <td>".$list[$i]['status_changed_date']."</td>
                                            <td>".$client['name']." - ".$client['str_type']." ".$client['street']." ".$client['number'].", ".$client['post_code']." ".$client['city']."</td>
                                            <td>".$list[$i]['symbol']."</td>
                                            <td><a href='/lab/show_certificate/".$list[$i]['id']."' target='_blank'><i class='fa fa-fw fa-file-pdf-o'></i> podgląd</a></td>
                                        </tr>";
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='4' class='text-center'>Brak dostępnych certyfikatów.</td></tr>";
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