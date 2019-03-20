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
                        <div class="panel-heading">Uprawnienia domyślne</div>
                        <div class="panel-body">
                            <form method="post" action="<?php echo $_this_path; ?>">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="well">
                                            <div style="max-height: 490px; overflow-y: auto;">
                                                <?php
                                                if($this->get('rights_tree'))
                                                {
                                                    foreach($this->get('rights_tree') as $file)
                                                    {
                                                        include_once($file);
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="text-right" style="padding-top: 10px;">
                                                <button type="submit" name="save" class="btn btn-primary btn-sm" value="Zapisz">Zapisz zmiany <i class="fa fa-floppy-o"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <h3>Uprawnienia domyślne</h3>
                                        <p>Uprawnienia domyślne jest to zestaw uprawnień domyślnie nadawanych użytkownikom podczas ich rejestracji w aplikacji.
                                           Po wysłaniu formularza zestaw domyślnych uprawnień użytkowników zostanie nadpisany.</p>
                                        <p>Uwaga: aktualne domyślne uprawnienia zostaną przypisane tylko nowym użytkownikom w systemie podczas ich rejestracji!
                                           Uprawnienia użytkowników istniejących nie zostaną zmienione!</p>
                                    </div>
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