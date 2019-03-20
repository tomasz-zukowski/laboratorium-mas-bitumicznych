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
                <?php
                $examination        = $this->get('examination');
                $client             = $this->get('client');
                $examination_type   = $this->get('examination_type');
                $contact            = $this->get('contact');
                $building           = $this->get('building');
                $examination_result = $this->get('examination_result');
                $deviations         = $this->get('deviations');
                $curve              = array_reverse($this->get('curve'));
                $sieves_set         = $this->get('sieves_set');
                ?>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6">
                            <i class="fa fa-info"></i> Szczegóły wykonanego badania
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_examination_details'))
                            {
                                echo '<a href="/lab/examination/'.$examination['id'].'"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrot</button></a> ';
                            }
                            if(Permissions::checkPermission('lab_register_certificate') || Permissions::checkPermission('lab_show_certificate'))
                            {
                                if(!$this->get('certificate'))
                                {
                                    echo '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#certificate"><i class="fa fa-certificate"></i> generuj świadectwo</button> ';
                                }
                                else
                                {
                                    echo '<a href="/lab/show_certificate/'.$examination['id'].'"><button class="btn btn-xs btn-success"><i class="fa fa-certificate"></i> wyświetl świadectwo</button></a> ';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 30%;"><i class="fa fa-fw fa-info"></i> Klient</th>
                                <th style="width: 35%;"><i class="fa fa-fw fa-flask"></i> Informacje o badaniu</th>
                                <th style="width: 35%;"><i class="fa fa-fw fa-flask"></i> Informacje o próbce</th>
                            </tr>
                        </thead>
                        <tr>
                            <td style="width: 30%;">
                                <p><i class="fa fa-fw fa-user"></i> Nazwa klienta:</p>
                                <?php
                                echo $client['name2'];
                                echo "<br /><i>".$client['str_type']." ".$client['street']." ".$client['number'].", ".$client['post_code']." ".$client['city']."</i><br /><br />";
                                ?>
                                <p><i class="fa fa-fw fa-truck"></i> Budowa:</p>
                                <?php
                                echo $building['name'];
                                echo "<br /><i>".$building['str_type']." ".$building['street']." ".$building['number'].", ".$building['post_code']." ".$building['city']."</i><br /><br />";
                                ?>
                                <p><i class="fa fa-fw fa-users"></i> Osoba kontaktowa:</p>
                                <?php
                                echo $contact['description'];
                                if(!empty($contact['phone']))
                                {
                                    echo "<p class='small' style='margin-top: 0px;'><i class='fa fa-phone'></i> ".$contact['phone']."</p>";
                                }
                                if(!empty($contact['email']))
                                {
                                    echo "<p class='small' style='margin-top: -10px;'><i class='fa fa-envelope-o'></i> <a>".$contact['email']."</a></p>";
                                }
                                if(!empty($contact['comments']))
                                {
                                    echo "<p class='small' style='margin-top: -10px; font-style: italic;'><i class='fa fa-comment-o'></i> ".$contact['comments']."</p>";
                                }
                                ?>
                            </td>
                            <td style="width: 35%;">
                                <p><i class="fa fa-fw fa-calendar-o"></i> Termin badania</p>
                                <?php
                                echo "<a href='/lab/schedule_month/".substr($examination['examination_date'],0,7)."'>".$examination['examination_date']."</a><br /><br />";
                                ?>
                                <p><i class="fa fa-fw fa-cube"></i> Rodzaj badania</p>
                                <?php
                                echo "<a href='/lab/examination_type/".$examination_type['id']."'>".$examination_type['symbol']."</a> - ".$examination_type['standard_name']."<br /><br />";
                                ?>

                                <p><i class="fa fa-fw fa-calendar"></i> Data wykonania badania</p>
                                <?php
                                echo "<a href='/lab/examination_results/".$examination['id']."'>".$examination['status_changed_date']." ".$examination['status_changed_time']."</a><br /><br />";
                                ?>

                                <p><i class="fa fa-fw fa-question"></i> Wynik badania</p>
                                <?php
                                if($examination_result['result']==1)
                                {
                                    echo "<button class='btn btn-default btn-lg btn-success disabled' style='width: 100%;'>Wynik badania: zgodny</button>";
                                }
                                else
                                {
                                    echo "<button class='btn btn-default btn-lg btn-danger disabled' style='width: 100%;'>Wynik badania: niezgodny</button>";
                                }
                                ?>
                            </td>
                            <td style="width: 35%;">
                                <p>Nazwa próbki</p>
                                <?php
                                echo $examination['sample_number']."<br /><br/>";
                                ?>

                                <p>Data dostarczenia</p>
                                <?php
                                echo $examination['collection_date']."<br /><br />";
                                ?>

                                <p>Sposób dostarczenia</p>
                                <?php
                                if($examination['sample_method']==1)
                                {
                                    echo "<p>Wysyłka</p>";
                                }
                                else
                                {
                                    echo "<p>Odbiór (<i>".$examination['collection_date']."</i>)</p>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th colspan="6" style="text-align: center;">Szczegółowe wyniki badania z dnia <?php echo $examination['status_changed_date']; ?></th>
                            </tr>
                            <tr>
                                <th>Przechodzi przez sito</th>
                                <th>Krzywa uziarnienia</th>
                                <th>Badanie laboratoryjne</th>
                                <th>Dop. odchyłka</th>
                                <th>Odchyłka</th>
                                <th>Wynik badania</th>
                            </tr>
                        </thead>
                        <?php
                        $_curve             = array();
                        foreach($curve as $key=>$value)
                        {
                            $mystring = $key;
                            $findme   = 'S';
                            if(strpos($mystring, $findme)!==false)
                            {
                                $_curve[$key]=$value;
                            }
                        }

                        foreach($_curve as $key=>$value)
                        {
                            if($_curve[$key]!='')
                            {
                                $diff = $examination_result[$key]-$_curve[$key];
                                echo "<tr>";
                                echo "<td style='text-align: right;'>".$sieves_set[$key]." [mm]</td>";
                                echo "<td>".$_curve[$key]."</td>";
                                echo "<td>".$examination_result[$key]."</td>";
                                echo "<td>".$deviations[$key.'l']."/+".$deviations[$key.'r']."</td>";
                                echo "<td>".number_format($diff,2)."</td>";
                                if($diff<$deviations[$key.'l'] || $diff>$deviations[$key.'r'])
                                {
                                    echo "<td><b>niezgodny</b></td>";
                                    $error = true;
                                }
                                else
                                {
                                    echo "<td>zgodne</td>";
                                }
                                echo "</tr>";
                            }
                        }
                        $diff = $examination_result['bitum']-$curve['bitum'];
                        echo "<tr>";
                        echo "<td style='text-align: right;'>zawartość asfaltu</td>";
                        echo "<td>".$curve['bitum']."</td>";
                        echo "<td>".$examination_result['bitum']."</td>";
                        echo "<td>".$deviations['bituml']."/+".$deviations['bitumr']."</td>";
                        echo "<td>".number_format($diff,2)."</td>";
                        if($diff<$deviations['bituml'] || $diff>$deviations['bitumr'])
                        {
                            echo "<td><b>niezgodny</b></td>";
                            $error = true;
                        }
                        else
                        {
                            echo "<td>zgodny</td>";
                        }
                        echo "</tr>";

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>