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
                        <h3><i class="fa fa-fw fa-wrench"></i><?php echo $this->get('header'); ?></h3>
                        <h5><?php echo $this->get('header_description'); ?></h5>
                    </div>
                    <div class="col-md-8">
                        <h3>Lista modułów</h3>
                        <div class="list-group" style="overflow-y: auto; max-height: 400px;">
                        <?php
                            $modules_list = $this->get('modules_list');
                            foreach($modules_list as $module)
                            {
                                if(is_file('Templates/'.$_SESSION['layout'].'/settings/settings_pages/'.$module['name'].'.php'))
                                {
                                    if(Permissions::checkPermission($module['name']))
                                    {
                                        ?>
                                        <a href="/settings/module/<?php echo $module['name']; ?>"
                                           class="list-group-item">
                                            <h4 class="list-group-item-heading"><?php echo $module['name']; ?></h4>

                                            <p class="list-group-item-text"><?php if(!empty($module['description'])) echo $module['description']; ?></p>
                                        </a>
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="list-group-item">
                                            <h4 class="list-group-item-heading"><?php echo $module['name']; ?><i class="fa fa-fw fa-ban fa-2x text-danger" title="Brak uprawnień" style="float: right;"></i></h4>

                                            <p class="list-group-item-text"><?php if(!empty($module['description'])) echo $module['description']; ?></p>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                <?php
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>