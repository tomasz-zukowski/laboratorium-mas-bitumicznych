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
                    <?php
                    if(isset($_POST) && !$this->isSetPromptWindow())
                    {
                        if(!isset($_POST['yes']))
                        {
                            Permissions::forwarding('/lab/standard/'.$this->get('standard'));
                        }
                    }
                    ?>
        </div>
    </div>
</div>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</body>
</html>