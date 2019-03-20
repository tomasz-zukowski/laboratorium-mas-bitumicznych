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
                            <i class="fa fa-calendar"></i> Harmonogram <a><?php echo $this->get('info','symbol'); ?></a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ul class="pagination pagination-sm" style="margin: -10px 10px;">
                                <li><a href='/lab/schedule_month/<?php echo ($this->get('year')-1).'/'.$this->get('month'); ?>'>&laquo;</a></li>
                                <li><a><?php echo $this->get('year'); ?></a></li>
                                <li><a href='/lab/schedule_month/<?php echo ($this->get('year')+1).'/'.$this->get('month'); ?>'>&raquo;</a></li>
                            </ul>
                            <ul class="pagination pagination-sm" style="margin: -10px;">
                                <li><a href='/lab/schedule_month/<?php echo date('Y/m',mktime(0,0,0,($this->get('month')),0,$this->get('year'))); ?>'>&laquo;</a></li>
                                <li><a style="width: 100px; text-align: center;"><?php echo $_SESSION['PL_months'][(int) $this->get('month')-1]; ?></a></li>
                                <li><a href='/lab/schedule_month/<?php echo date('Y/m',mktime(0,0,0,($this->get('month'))+2,0,$this->get('year'))); ?>'>&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th style="width: 14%"> pon</th>
                            <th style="width: 14%"> wt</th>
                            <th style="width: 14%"> śr</th>
                            <th style="width: 14%"> cz</th>
                            <th style="width: 14%"> pt</th>
                            <th style="width: 14%"> sob</th>
                            <th style="width: 14%"> n </th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $year          = $this->get('year');
                        $month         = $this->get('month');
                        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                        $week_day      = date("N", strtotime("$year-$month-01"));
                        $rows          = ceil(($days_in_month + $week_day - 1) / 7);

                        function week_number($data)
                        {
                            list($rok, $miesiac, $dzien) = explode("-", trim($data));
                            if(!checkdate($miesiac, $dzien, $rok)) return 0;

                            return date("W", mktime(0, 0, 0, $miesiac, $dzien, $rok));
                        }

                        $week_number = week_number($year . "-" . $month . "-1")-1;

                        if($month == 1) $week_number = 0;
                        $day = 1;

                        for($i = 0; $i < $rows; $i++)
                        {
                            $week_number++;

                            echo '<tr><td style="font-size: 10px">' . $week_number . '</td>';

                            for($j = 1; $j <= 7; $j++)
                            {
                                $temp_date = date("Y-m-d", strtotime("$year-$month-$day"));

                                if($week_day == $j && $day == 1)
                                {
                                    $color = null;
                                    $alt     = null;

                                    echo "<td style='background: $color;'>
                                            <a title='$alt' href='/lab/schedule_day/$year-$month-0$day'>
                                                <span> $day </span>
                                            </a>
                                          </td>";

                                    $day++;
                                }
                                else if($day <= $days_in_month && $day != 1 )
                                {

                                    $color = null;
                                    $alt     = null;

                                    if(in_array($temp_date,$this->get('examination_terms')))
                                    {
                                        $color = '#f2dcdb';
                                        $alt     = 'Termin';
                                    }

                                    if(in_array($temp_date,$this->get('examination_dates')))
                                    {
                                        $color = '#ebf1dd';
                                        $alt     = 'Badanie';
                                    }

                                    if(in_array($temp_date,$this->get('examination_dates')) && in_array($temp_date,$this->get('examination_terms')))
                                    {
                                        $color = '#e5e0ec';
                                        $alt     = 'Badanie | Termin';
                                    }
                                    
                                    if($day < 10)
                                    {
                                        echo "<td style='background: $color;'>
                                                <a title='$alt' href='/lab/schedule_day/$year-$month-0$day'>
                                                    <span> $day </span>
                                                </a>
                                              </td>";
                                    }
                                    else
                                    {
                                        echo "<td style='background: $color;'>
                                                <a title='$alt' href='/lab/schedule_day/$year-$month-$day'>
                                                    <span> $day </span>
                                                </a>
                                              </td>";
                                    }
                                    $day++;
                                }
                                else
                                {
                                    echo '<td></td>';
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <div style="width: 400px; float: right;">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center" style="width: 33%; background-color: #f2dcdb;">Terminy</td>
                                <td class="text-center" style="width: 33%; background-color: #ebf1dd;">Badania</td>
                                <td class="text-center" style="width: 33%; background-color: #e5e0ec;">Terminy/Badania</td>
                            </tr>
                        </table>
                    </div>
                    <div style="width: 100%;">
                        <p>Liczba badań do przeprowadzenia w wybranym miesiącu: <?php echo count($this->get('examination_terms')); ?></p>
                        <p>Liczba badań przeprowadzonych od początku roku: <?php echo count($this->get('examination_dates_year')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>