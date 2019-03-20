<!DOCTYPE html>
<html>
<head>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
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
                            <i class="fa fa-cube"></i> Typ badań <a><?php echo $this->get('info','symbol'); ?></a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_examination_types')) echo '<a href="/lab/examination_types/"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                            if(Permissions::checkPermission('lab_archivize')) echo '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-history"></i> archiwiuj</button> ';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5><i class="fa fa-info"></i> Informacje o typie badania: </h5>
                            <table class="table">
                                <tr>
                                    <td style="width: 35%;"><label>Symbol:</label></td>
                                    <td><?php echo $this->get('info','symbol'); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Standard:</label></td>
                                    <td><?php echo $this->get('info','standard_name'); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Opis:</label></td>
                                    <td><?php echo $this->get('info','standard_description'); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Typ:</label></td>
                                    <td><?php echo $this->get('info','standard_type'); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Kategoria:</label></td>
                                    <td><?php echo $this->get('info','standard_categorie'); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <div class="row">
                                            <div class="col-sm-12"><i class="fa fa-line-chart"></i> Krzywa uziarnienia</div>
                                        </div>
                                    </h5>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <?php
                                        if($curve = $this->get('curve'))
                                        {
                                            echo "<i>Krzywa uziarnienia mieszanki została zarejestrowana dnia ".$curve['register_date']."</i><span>";
                                            if(Permissions::checkPermission('lab_delete_curve'))
                                            echo "<button class='btn btn-xs' title='Usuń krzywą uziarnienia' data-toggle='modal' data-target='#delete_curve' style='float: right; background-color: transparent; color: red;'><i class='fa fa-fw fa-trash-o'></i></button>";
                                        }
                                        else
                                        {
                                            echo "Krzywa uziarnienia nie została zarejestrowana. <a href='/lab/register_curve/".$this->get('info','id')."'>Zarejestruj</a> krzywą uziarnienia mieszanki.";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <h5>
                                        <div class="row">
                                            <div class="col-sm-12"><i class="fa fa-flask"></i> Ostatnie badania</div>
                                        </div>
                                    </h5>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <ul>
                                            <?php
                                            if($mixtures=$this->get('mixtures'))
                                            {
                                                if(count($mixtures)>10)
                                                {
                                                    $ilosc=10;
                                                }
                                                else
                                                {
                                                    $ilosc = count($mixtures);
                                                }

                                                for($i=0;$i<$ilosc;$i++)
                                                {
                                                    if($mixtures[$i]['status']==1)
                                                    {
                                                        $status = '<i class="fa fa-fw fa-check"></i> wykonane';
                                                    }
                                                    else
                                                    {
                                                        $status = '<i class="fa fa-fw fa-ban"></i> oczekujące';
                                                    }
                                                    echo "<li>
                                                            <a href='/lab/examination/".$mixtures[$i]['id']."'>".$mixtures[$i]['examination_date']."</a>
                                                             - <b>Próbka:</b> ".$mixtures[$i]['sample_number'].", <b>Status:</b> ".$status."
                                                          </li>";
                                                }
                                            }
                                            else
                                            {
                                                echo "<li>Brak zarejestrowanych badań.</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>