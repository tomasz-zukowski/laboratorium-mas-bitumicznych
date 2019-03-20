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
                            <i class="fa fa-list"></i> Lista zainstalowanych modułów
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="/modules/preinstall"><button class="btn btn-xs btn-info"><i class="fa fa-plus"></i> zainstaluj moduł </button></a>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Nazwa</th>
                                <th>Opis</th>
                                <th style="width: 15%; text-align: center;">Wersja</th>
                                <th style="width: 2%;">Off/On</th>
                            </tr>
                        </thead>
                        <?php
                        for($i=0;$i<count($modules = $this->get('modules'));$i++)
                        {
                            echo "<tr>
                                    <td><a href=''>".$modules[$i]['name']."</td>
                                    <td>".$modules[$i]['description']."</td>
                                    <td style='text-align: center;'>".$modules[$i]['version']."</td>";
                            if($modules[$i]['required']==1)
                            {
                                echo "<td style='text-align: center;'>";
                                echo "<button class='fa fa-lock popover-btn' style='width: 30px;' data-container='body' data-toggle='popover' data-placement='right' data-content='Ten moduł jest częścią silnika aplikacji i nie może zostać usunięty ani wyłączony!' data-trigger='focus'></button>";
                                echo "</td>";
                            }
                            else
                            {
                                echo "<td style='text-align: center;'>";
                                if($modules[$i]['_active']==0)
                                echo "<a href='/modules/switch_active/".$modules[$i]['name']."'><button class='fa fa-toggle-off' style='width: 30px;'></button></a>";
                                else
                                echo "<a href='/modules/switch_active/".$modules[$i]['name']."'><button class='fa fa-toggle-on' style='width: 30px;'></button></a>";
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
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