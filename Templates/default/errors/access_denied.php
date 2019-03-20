<!DOCTYPE html>
<html>
    <head>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/header.php'; ?>
    </head>
    <body>
    <?php include 'Templates/'.$_SESSION['layout'].'/Const/main_nav_bar.php'; ?>
    <div class="container">
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/alerts.php'; ?>
        <div class="row"><div class="col-sm12"></div> </div>
        <div class="row">
            <div class="col-md-12">
                <div class="well panel-">
                    <h2 class="text-center">Odmowa dostępu, nie posiadasz uprawnień do przeglądania tej strony !</h2>
                    <h3 class="text-center"><a href="<?php echo (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '/home/index'; ?>">Zawróć !</a></h3>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>