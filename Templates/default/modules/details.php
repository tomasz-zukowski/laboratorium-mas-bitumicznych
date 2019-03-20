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
                            <i class="fa fa-list"></i> Lista zainstalowanych modułów
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="/modules/preinstall"><button class="btn btn-xs btn-info"><i class="fa fa-plus"></i> zainstaluj moduł </button></a>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                    <div class="well">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>