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
                            <i class="fa fa-cube"></i> Standard <a><?php echo $this->get('standard_info','name'); ?></a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_standards')) echo '<a href="/lab/standard_list"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                            if(Permissions::checkPermission('lab_standard_edit')) echo '<a href="/lab/edit_standard/'.$this->get('standard_info','id').'"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> edytuj</button></a> ';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5><i class="fa fa-info"></i> Informacje o standardzie: </h5>
                            <table class="table">
                                <tr>
                                    <td style="width: 35%;"><label>Nazwa:</label></td>
                                    <td><?php echo $this->get('standard_info','name'); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Dokument:</label></td>
                                    <td><?php echo $this->get('standard_info','document'); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Rok:</label></td>
                                    <td><?php echo $this->get('standard_info','year'); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Status:</label></label></td>
                                    <td>
                                        <?php
                                        if($this->get('standard_info','_active')==1)
                                        {
                                            echo "<i class='fa fa-toggle-on'></i> aktywny";
                                        }
                                        else
                                        {
                                            echo "<i class='fa fa-toggle-off'></i> nieaktywny";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <h5>
                                <div class="row">
                                    <div class="col-sm-9"><i class="fa"></i> Zarejestrowane opisy</div>
                                    <div class="col-sm-3 text-right">
                                        <a href="/lab/manage_descriptions/<?php echo $this->get('standard_info','id'); ?>"><span class="label label-default label-x">opisy</span></a>
                                    </div>
                                </div>
                            </h5>
                            <div style="max-height: 300px; overflow-y: auto;">
                                <ul>
                                    <?php
                                    if($descriptions = $this->get('descriptions'))
                                    {
                                        for($i=0;$i<count($descriptions);$i++)
                                        {
                                            echo "<li>".$descriptions[$i]['description']."</li>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<li>Brak zarejestrowanych opisów</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>
                                        <div class="row">
                                            <div class="col-sm-9"><i class="fa"></i> Zarejestrowane typy</div>
                                            <div class="col-sm-3 text-right">
                                                <a href="/lab/manage_types/<?php echo $this->get('standard_info','id'); ?>"><span class="label label-default label-x">typy</span></a>
                                            </div>
                                        </div>
                                    </h5>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <ul>
                                            <?php
                                            if($types = $this->get('types'))
                                            {
                                                for($i=0;$i<count($types);$i++)
                                                {
                                                    echo "<li>".$types[$i]['type']."</li>";
                                                }
                                            }
                                            else
                                            {
                                                echo "<li>Brak zarejestrowanych typów</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <div class="row">
                                            <div class="col-sm-9"><i class="fa"></i> Zarejestrowane kategorie</div>
                                            <div class="col-sm-3 text-right">
                                                <a href="/lab/manage_categories/<?php echo $this->get('standard_info','id'); ?>"><span class="label label-default label-x">kategorie</span></a>
                                            </div>
                                        </div>
                                    </h5>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <ul>
                                            <?php
                                            if($categories = $this->get('categories'))
                                            {
                                                for($i=0;$i<count($categories);$i++)
                                                {
                                                    echo "<li>".$categories[$i]['categorie']."</li>";
                                                }
                                            }
                                            else
                                            {
                                                echo "<li>Brak zarejestrowanych kategorii.</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-12">
                                    <i class="fa fa-list"></i> Mieszanki
                                    <table class="table" style="font-size: 10px;">
                                    <?php
                                    if(!empty($types) && !empty($categories))
                                    {
                                        $_model = $this->get('model');
                                        for($i=0;$i<count($categories);$i++)
                                        {
                                            echo "<tr>";
                                            for($j=0;$j<count($types);$j++)
                                            {
                                                echo "<td><a href='/lab/standard_mixes/".$types[$j]['id']."/".$categories[$i]['id']."'>";
                                                if($_model->getData("SELECT * FROM lab_standards_borders WHERE _categorie = '".$categories[$i]['id']."' AND _type = '".$types[$j]['id']."' LIMIT 1"))
                                                {
                                                    echo "<i class='fa fa-fw fa-check text-success'></i>";
                                                }
                                                else
                                                {
                                                    echo "<i class='fa fa-fw fa-ban text-danger'></i>";
                                                }
                                                echo $types[$j]['type']."<br />".$categories[$i]['categorie'];
                                                echo "</a></td>";
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>Dopuszczalne odchyłki wartości badań od krzywej granicznej</p>
                                    <table class="table">
                                        <?php
                                        if($deviations = $this->get('deviations'))
                                        {
                                            echo "<p><i class='fa fa-fw fa-check text-success'></i><i>Dopuszczalne odchyłki badań zostały określone - </i>";
                                            if(Permissions::checkPermission('lab_standard_edit_deviations'))
                                            {
                                                echo "<a href='/lab/set_deviations/".$this->get('standard_info','id')."'><i class='fa fa-fw fa-pencil'></i></a>";
                                            }
                                            echo "</p>";
                                        }
                                        else
                                        {
                                            echo "<p><i>Należy określić dopuszczalne <a href='/lab/set_deviations/".$this->get('standard_info','id')."'>odchyłki badań</a> !</i></p>";
                                        }
                                        ?>
                                    </table>
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