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
                            <i class="fa fa-list"></i> Lista wykonanych badań
                        </div>
                        <div class="col-sm-6 text-right">
                            <ul class="pagination pagination-sm" style="margin: -10px 10px;">
                                <li><a href='/lab/examinations_archive/<?php echo ($this->get('year')-1).'/'.$this->get('month'); ?>'>&laquo;</a></li>
                                <li><a><?php echo $this->get('year'); ?></a></li>
                                <li><a href='/lab/examinations_archive/<?php echo ($this->get('year')+1).'/'.$this->get('month'); ?>'>&raquo;</a></li>
                            </ul>
                            <ul class="pagination pagination-sm" style="margin: -10px;">
                                <li><a href='/lab/examinations_archive/<?php echo date('Y/m',mktime(0,0,0,($this->get('month')),0,$this->get('year'))); ?>'>&laquo;</a></li>
                                <li><a style="width: 100px; text-align: center;"><?php echo $_SESSION['PL_months'][(int) $this->get('month')-1]; ?></a></li>
                                <li><a href='/lab/examinations_archive/<?php echo date('Y/m',mktime(0,0,0,($this->get('month'))+2,0,$this->get('year'))); ?>'>&raquo;</a></li>
                            </ul>
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
                                <th style="width: 15%; text-align: center;">Data badania</th>
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
                                            <td>".$list[$i]['symbol']."</td>
                                            <td>".$list[$i]['status_changed_date']." ".$list[$i]['status_changed_time']."</td>";
                                    echo "</tr>";
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='4' class='text-center'>Brak wykonanych badań w wybranym miesiącu.</td></tr>";
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