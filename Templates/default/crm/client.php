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
                            <i class="fa fa-user"></i> Klient <a><?php echo $this->get('client_info','name2'); ?></a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('crm_review')) echo '<a href="/crm/review"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                            if(Permissions::checkPermission('crm_edit')) echo '<a href="/crm/edit_client/'.$this->get('client_info','id').'"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> edytuj</button></a> ';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table">
                                        <tr>
                                            <td style="width: 35%;"><label>Nazwa:</label></td>
                                            <td><?php echo $this->get('client_info','name'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Pełna nazwa:</label></td>
                                            <td><?php echo $this->get('client_info','name2'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Adres:</label></td>
                                            <td id="address" data-address="<?php echo $this->get('client_info','str_type')." ".$this->get('client_info','street')." ".$this->get('client_info','number').", ".$this->get('client_info','post_code')." ".$this->get('client_info','city'); ?>"><?php echo $this->get('client_info','str_type')." ".$this->get('client_info','street')." ".$this->get('client_info','number').",<br />".$this->get('client_info','post_code')." ".$this->get('client_info','city'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Kraj:</label></td>
                                            <td><?php echo $this->get('client_info','country'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>NIP:</label></td>
                                            <td><?php echo substr($this->get('client_info','nip'),0,3)."-".substr($this->get('client_info','nip'),3,2)."-".substr($this->get('client_info','nip'),5,2)."-".substr($this->get('client_info','nip'),7,3); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>EU NIP:</label></td>
                                            <td><?php echo $this->get('client_info','eunip'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Opis działności:</label></td>
                                            <td><?php echo $this->get('client_info','activity_description'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Status:</label></label></td>
                                            <td>
                                                <?php
                                                if($this->get('client_info','_active')==1)
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>
                                        <div class="row">
                                            <div class="col-sm-9"><i class="fa fa-group"></i> Zarejestrowane kontakty</div>
                                            <div class="col-sm-3 text-right">
                                                <a href="/crm/new_contact/<?php echo $this->get('client_info','id'); ?>"><span class="label label-default label-x">+ kontakt</span></a>
                                            </div>
                                        </div>
                                    </h5>
                                    <ul class="list-group">
                                        <?php
                                        if($contacts = $this->get('client_contacts'))
                                        {
                                            for($i=0;$i<count($contacts);$i++)
                                            {
                                                echo "<li class='list-group-item'>";
                                                echo "<p>";
                                                echo $contacts[$i]['description'];
                                                if(Permissions::checkPermission('crm_edit_contact'))
                                                {
                                                    echo "<a title='Edytuj' href='/crm/edit_contact/".$this->get('client_info','id')."/".$contacts[$i]['id']."'><i style='float: right;' class='fa fa-fw fa-pencil'></i></a>";
                                                }
                                                echo "</p>";
                                                if(!empty($contacts[$i]['phone']))
                                                {
                                                    echo "<p class='small' style='margin-top: -10px;'><i class='fa fa-phone'></i> ".$contacts[$i]['phone']."</p>";
                                                }
                                                if(!empty($contacts[$i]['email']))
                                                {
                                                    echo "<p class='small' style='margin-top: -10px;'><i class='fa fa-envelope-o'></i> <a>".$contacts[$i]['email']."</a></p>";
                                                }
                                                if(!empty($contacts[$i]['comments']))
                                                {
                                                    echo "<p class='small' style='margin-top: -10px; font-style: italic;'><i class='fa fa-comment-o'></i> ".$contacts[$i]['comments']."</p>";
                                                }
                                                echo "</li>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<li class='list-unstyled'>Brak zarejestrowanych kontaktów. Dodaj <a href='/crm/new_contact/".$this->get('client_info','id')."'>nowy kontakt</a>.</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5><i class="fa fa-map-marker"></i> Lokalizacja klienta</h5>
                                    <div id="map-canvas" style="width: 100%; height: 200px;"></div>
                                    <h5 id="status" class="text-right" style="margin-bottom: 30px;"></h5>
                                    <hr />
                                </div>
                            </div>
                            <?php
                            if(Permissions::checkModule('lab'))
                            {
                                ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5><i class="fa fa-flask"></i> Zlecone badania</h5>
                                        <div style="max-height: 200px; overflow-y: auto;">
                                            <ul>
                                                <?php
                                                if($mixtures=$this->get('mixtures'))
                                                {
                                                    for($i=0;$i<count($mixtures);$i++)
                                                    {
                                                        if($mixtures[$i]['status']==1)
                                                        {
                                                            $status = '<i class="fa fa-fw fa-check"></i> wykonane';
                                                        }
                                                        else
                                                        {
                                                            $status = '<i class="fa fa-fw fa-ban"></i> oczekujące';
                                                        }
                                                        echo "<li><a href='/lab/examination/".$mixtures[$i]['id']."'>".$mixtures[$i]['examination_date']."</a> - <a href='/lab/examination_type/".$mixtures[$i]['_examination_type']."'> ".$mixtures[$i]['symbol']."</a> - <b>Próbka:</b> ".$mixtures[$i]['sample_number'].", <b>Status:</b> ".$status."</li>";
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<li>Brak zarejestrowanych badań.</li>";
                                                }
                                                ?>
                                            </ul>
                                            <hr />
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>
                                        <div class="row">
                                            <div class="col-sm-9"><i class="fa fa-truck"></i> Zarejestrowane budowy</div>
                                            <div class="col-sm-3 text-right">
                                                <a href="/crm/new_building/<?php echo $this->get('client_info','id'); ?>"><span class="label label-default label-x">+ budowa</span></a>
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-group">
                                    <?php
                                    if($buildings = $this->get('client_buildings'))
                                    {
                                        for($i=0;$i<count($buildings);$i++)
                                        {
                                            echo "<li class='list-group-item'>";
                                            echo "<p>";
                                            echo $buildings[$i]['name'];
                                            if(Permissions::checkPermission('crm_edit_building'))
                                            {
                                                echo "<a title='Edytuj' href='/crm/edit_building/".$this->get('client_info','id')."/".$buildings[$i]['id']."'><i style='float: right;' class='fa fa-fw fa-pencil'></i></a>";
                                            }
                                            echo "</p>";
                                            echo "<p class='small' style='margin-top: -10px;'><i class='fa fa-map-marker'></i> ".$this->get('client_info','str_type')." ".$this->get('client_info','street')." ".$this->get('client_info','number').", ".$this->get('client_info','post_code')." ".$this->get('client_info','city')."</p>";
                                            if(!empty($buildings[$i]['comments']))
                                            {
                                                echo "<p class='small' style='margin-top: -10px; font-style: italic;'><i class='fa fa-comment-o'></i> ".$buildings[$i]['comments']."</p>";
                                            }
                                            echo "</li>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<li class='list-unstyled'>Brak zarejestrowanych budów. Dodaj <a href='/crm/new_building/".$this->get('client_info','id')."'>nową budowę</a>.</li>";
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
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>