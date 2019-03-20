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
                            <i class="fa fa-cube"></i> Rejestracja nowego standardu
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if(Permissions::checkPermission('lab_standards'))
                            {
                                echo '<a href="/lab/standard_list"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrot</button></a> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/lab/new_standard">
                        <table class="table">
                            <tr>
                                <th style="width: 30%;"><i class="fa fa-cube"></i> Nazwa</th>
                                <th><i class="fa fa-file-o"></i> Dokument</th>
                                <th style="width: 25%;" colspan="2"><i class="fa fa-calendar-o"></i> Rok</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','name','class'); ?>">
                                        <input class="form-control" type="text" name="name" placeholder="Nazwa standardu" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ""; ?>" required maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','name','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','document','class'); ?>">
                                        <input class="form-control" type="text" name="document" placeholder="Nazwa dokumentu" value="<?php echo (isset($_POST['document'])) ? $_POST['document'] : ""; ?>" required maxlength="255" />
                                        <a class="help-block"><?php echo $this->get('form_errors','document','error_msg'); ?></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','year','class'); ?>">
                                        <input class="form-control" type="text" name="year" placeholder="Rok wydania" value="<?php echo (isset($_POST['year'])) ? $_POST['year'] : ""; ?>" required maxlength="4" />
                                        <a class="help-block"><?php echo $this->get('form_errors','year','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;" colspan="3"><input type="submit" class="btn btn-primary btn-sm" value="Rejestruj standard" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>