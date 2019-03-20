<!DOCTYPE html>
<html>
    <head>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/header.php'; ?>
    </head>
    <body>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/main_nav_bar_unlogged.php'; ?>
        <div class="container">
            <?php include 'Templates/'.$_SESSION['layout'].'/Const/alerts.php'; ?>
            <div class="row">
                <div class="row"></div>
                <div class="col-sm-7">
                    <div>
                        <h3>Logowanie</h3>
                        <p><?php echo $this->get('hello_msg'); ?></p>
                    </div>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <form class="well well-sm" action="<?php echo $_this_path; ?>" method="post">
                        <div class="form-group has-feedback">
                            <label>login</label>
                            <div class="input-group <?php echo $this->get('form_errors','password','class'); ?>">
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                <input type="text" name="u_login" class="form-control input-sm" placeholder="podaj nazwę użytkownika" autofocus>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label>hasło</label>
                            <div class="input-group <?php echo $this->get('form_errors','password','class'); ?>">
                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                <input type="password" name="u_haslo" class="form-control input-sm" placeholder="wprowadź hasło">
                            </div>
                            <a class="help-block" style="color: red;"><?php echo $this->get('form_errors','password','error_msg'); ?></a>
                        </div>
                        <?php
                        if($this->get('_alert_panel'))
                        {
                            echo '<button type="button" class="btn btn-primary btn-sm popover-btn" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Możliwość logowania w tym momencie jest niedostepna!"><i class="fa fa-fw fa-sign-in"></i> Zaloguj</button>';
                        }
                        else
                        {
                            echo '<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-fw fa-sign-in"></i> Zaloguj</button>';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>