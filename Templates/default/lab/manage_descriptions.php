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
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6">
                            <i class="fa fa-cubes"></i> Lista zarejestrowanych opisów standardu <a><?php echo $this->get('standard_info','name'); ?></a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_standard_details'))
                            {
                                echo '<a href="/lab/standard/'.$this->get('standard_info','id').'"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-cube"></i> Opis</th>
                                <th style="width: 10%;"></th>
                            </tr>
                        </thead>
                    </table>
                    <div style="max-height: 400px; overflow-y: auto; margin-top: -22px;">
                        <table class="table table-hover">
                            <tbody>
                                <?php
                                if($list = $this->get('list'))
                                {
                                    for($i=0;$i<count($list);$i++)
                                    {
                                        echo "<tr>
                                                <td>".$list[$i]['description']."</td>
                                                <td style='text-align: right; width:30%;'><a href='/lab/delete_description/".$this->get('standard_info','id')."/".$list[$i]['id']."'><i class='fa fa-fw fa-trash'></i> </a></td>
                                            </tr>";
                                    }
                                }
                                else
                                {
                                    echo "<tr><td colspan='3' class='text-center'>Brak zarejestrowanych opisów.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-plus"></i> Nowy opis mieszanki
                </div>
                <div class="panel-body">
                    <form action="<?php echo $_this_path; ?>" method="POST">

                        <label>Opis</label>
                        <div class="form-group <?php echo $this->get('form_errors','description','class'); ?>">
                            <input type="text" class="form-control" name="description" value="<?php echo (isset($_POST['description'])) ? $_POST['description'] : ''; ?>" placeholder="Opis mieszanki" required />
                        </div>
                        <a class="help-block"><?php echo $this->get('form_errors','description','error_msg'); ?></a>

                        <div style="width: 100%;" class="text-right">
                            <br /><button class="btn btn-primary btn-sm" type="submit">Dodaj opis <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>