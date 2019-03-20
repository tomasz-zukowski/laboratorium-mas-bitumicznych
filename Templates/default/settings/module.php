<!DOCTYPE html>
<html>
    <head>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/header.php'; ?>
    </head>
    <body>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/main_nav_bar.php'; ?>
        <div class="container">
            <?php include 'Templates/'.$_SESSION['layout'].'/Const/alerts.php'; ?>
            <div class="well">
                <div class="row"><div class="col-sm12"></div> </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3><i class="fa fa-fw fa-gear"></i>Moduł <?php echo $this->get('module_name'); ?></h3>
                        <h5></h5>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if(is_file('Templates/'.$_SESSION['layout'].'/settings/'.$this->get('module_settings_path').'.php'))
                        {
                            $this->render($this->get('module_settings_path'));
                        }
                        else
                        {
                            echo "<h3>Brak zdefiniowanej strony ustawień dla tego modułu!</h3>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>