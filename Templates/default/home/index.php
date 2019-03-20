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
                    <div class="well">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1>Strona główna</h1>
                                Witaj na stronie głównej aplikacji. Aby korzystać z wielu funkcjonalności jakie oferuje niniejsza aplikacja skorzystaj z nawigacji, która znajduje się w górnej części ekranu.<br /><br />
                                Pamiętaj, że dostep do niektórych funkcji uwarunkowane jest posiadaniem odpowiednich uprawnień! <br /><br />
                                W przypadku jakichkolwiek pytań skontaktuj się z administratorem.<br />

                                <h4 class="text-right">Miłej pracy!</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>