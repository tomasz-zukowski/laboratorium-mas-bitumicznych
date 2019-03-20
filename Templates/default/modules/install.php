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
                        <div class="panel-heading">Przywracanie danych</div>
                        <div class="panel-body" id="results" style="max-height: 400px; overflow-y: auto;">
                            <?php
                            if(isset($_POST) && !empty($_FILES))
                            {
                                $this->Model->installModuleFromZIP($this->get('file_path'),$this->get('file_name'),$this->get('file_key'));
                            }
                            else
                            {
                                Permissions::forwarding('/modules/preinstall/');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>