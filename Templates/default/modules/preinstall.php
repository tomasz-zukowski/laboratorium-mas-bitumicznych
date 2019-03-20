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
                <div class="panel panel-heading">
                    <div class="row">
                        <div class="col-sm-12">
                            <i class="fa fa-file-zip-o"></i> Instalator nowego modułu
                        </div>
                    </div>
                </div>
                <div class="panel panel-body">
                    <h3>Instalator nowego modułu</h3>
                    <form method="POST" action="<?php echo $_path."/modules/install/"; ?>" enctype="multipart/form-data">
                        <table class="table table-responsive">
                            <tr>
                                <td style="width: 40%;"><label>Plik modułu aplikacji</label></td>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','package_file','class'); ?>">
                                        <input class="form-control" type="file" accept="application/zip" name="package_file" value="<?php echo (isset($_POST['package_file'])) ? $_POST['package_file'] : ""; ?>" required />
                                        <a class="help-block text-info">Archiwum zip zawierające pliki modułu wraz ze strukturą bazy danych</a>
                                        <a class="help-block"><?php echo $this->get('form_errors','package_file','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;"><label>Klucz dostępu do archiwum <small style="font-style: italic;">(jeśli wymagany)</small></label></td>
                                <td>
                                    <div class="form-group <?php echo $this->get('form_errors','package_key','class'); ?>">
                                        <input class="form-control" type="password" name="package_key" value="<?php echo (isset($_POST['package_key'])) ? $_POST['package_key'] : ""; ?>" placeholder="Klucz dostępu" />
                                        <a class="help-block"><?php echo $this->get('form_errors','package_key','error_msg'); ?></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">
                                    <button class="btn btn-primary btn-sm" type="submit">Rozpocznij instalację <i class="fa fa-arrow-right"></i></button>
                                </td>
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