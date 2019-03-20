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
                            <i class="fa fa-info"></i> Szczegóły zleconego badania
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_examination_list'))
                            {
                                echo '<a href="/lab/examinations"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrot</button></a> ';
                            }

                            if(Permissions::checkPermission('lab_delete_examination') && $this->get('examination','status')==0)
                            {
                                echo '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> usuń zlecenie</button> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                    $examination      = $this->get('examination');
                    $client           = $this->get('client');
                    $examination_type = $this->get('examination_type');
                    $contact          = $this->get('contact');
                    $building         = $this->get('building');
                    ?>
                    <table class="table">
                        <tr>
                            <td style="width: 33%;"><i class="fa fa-fw fa-user"></i> Klient</td>
                            <td><i class="fa fa-fw fa-truck"></i> Budowa</td>
                            <td style="width: 33%;" colspan="2"><i class="fa fa-fw fa-users"></i> Osoba kontaktowa</td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                echo "<a href='/crm/client/".$client['id']."'>".$client['name2']."</a>";
                                echo "<br /><i>".$client['str_type']." ".$client['street']." ".$client['number'].", ".$client['post_code']." ".$client['city']."</i>";
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $building['name'];
                                echo "<br /><i>".$building['str_type']." ".$building['street']." ".$building['number'].", ".$building['post_code']." ".$building['city']."</i>";
                                ?>
                            </td>
                            <td>
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
                        </tr>
                        <tr>
                            <td style="width: 33%"><i class="fa fa-fw fa-calendar-o"></i> Termin wykonania badania</td>
                            <td style="width: 33%"><i class="fa fa-fw fa-cube"></i> Rodzaj badania</td>
                            <td style="width: 33%"><i class="fa fa-fw fa-calendar-o"></i> Data wykonania badania</td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                echo "<a href='/lab/schedule_month/".substr($examination['examination_date'],0,7)."'>".$examination['examination_date']."</a>";
                                ?>
                            </td>
                            <td>
                                <?php
                                echo "<a href='/lab/examination_type/".$examination_type['id']."'>".$examination_type['symbol']."</a> - ".$examination_type['standard_name'];
                                ?>
                            </td>
                            <td>
                                <?php
                                if(!empty($examination['status_changed_date']))
                                {
                                    echo "<a href='/lab/examination_results/".$examination['id']."'>".$examination['status_changed_date']." ".$examination['status_changed_time']."</a>";
                                }
                                else
                                {
                                    if($examination['sample_status']==1)
                                    {
                                        if(Permissions::checkPermission('lab_run_examination'))
                                        {
                                            echo "<a href='/lab/run_examination/".$examination['id']."'><i class='fa fa-fw fa-flask text-success'></i> Wykonaj badanie</a>";
                                        }
                                        else
                                        {
                                            echo "<a>Brak uprawnień do wykonywania badań</a>";
                                        }
                                    }
                                    else
                                    {
                                        if(Permissions::checkPermission('lab_confirm_sample'))
                                        {
                                            echo "<a><i class='fa fa-fw fa-ban text-danger'></i> Potwierdź próbkę</a>";
                                        }
                                        else
                                        {
                                            echo "<a>Brak uprawnień do potwierdzania próbek</a>";
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <i class="fa fa-fw fa-info"></i>Informacje o próbce
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Status próbki <b><?php echo $examination['sample_number']; ?></b>:</p>
                                <?php
                                if($examination['sample_status']==1)
                                {
                                    echo "<p>Dostarczona (<i>".$examination['collection_date']."</i>)</p>";
                                }
                                else
                                {
                                    echo "<p>Oczekująca</p>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($examination['sample_sample_status']!=1)
                                {
                                    echo "<p>Sposób dostarczenia:</p>";
                                    if($examination['sample_method']==1)
                                    {
                                        echo "<p>Wysyłka</p>";
                                    }
                                    else
                                    {
                                        echo "<p>Odbiór (<i>".$examination['collection_date']."</i>)</p>";
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <p>&ensp;</p>
                                <?php
                                if($examination['user']==0)
                                {
                                    echo "<button class='btn btn-sm btn-success' data-toggle='modal' data-target='#confirm_sample'><i class='fa fa-fw fa-check'></i> Potwierdz dostarczenie</button>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>