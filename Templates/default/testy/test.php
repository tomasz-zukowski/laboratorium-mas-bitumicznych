<!DOCTYPE html>
<html>
    <head>
    <?php include 'Templates/'.$_SESSION['layout'].'/Const/header.php'; ?>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Rozwiń nawigację</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Nawigacja</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/home/index">Strona główna</a></li>
                    <li><a href="/home/index">Kontrahenci</a></li>
                    <li><a href="/home/index">Dokumenty</a></li>
                    <li><a href="/home/index">Użytkownicy</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li style="margin-right: 15px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm navbar-btn" >
                                <?php echo $_SESSION['user']; ?>
                            </button>
                            <button type="button" class="btn btn-info btn-sm navbar-btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" style="border-radius: 0px; margin-top: 0px;" role="menu">
                                <li><a href="#">Test</a></li>
                                <li><div class="divider"></div></li>
                                <li><a href="/users/log_out">Wyloguj</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row"><div class="col-sm12"></div> </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Dokumenty</h3>
                        <div class="list-group" style="overflow: auto;">
                            <a href="#" class="list-group-item">Zakładanie katalogu</a>
                            <a href="#" class="list-group-item">Rejestracja dokumentu</a>
                            <a href="#" class="list-group-item">Operacje na dokumencie</a>
                            <a href="#" class="list-group-item">Edycja dokumentu</a>
                            <a href="#" class="list-group-item">Zatwierdzanie dokumentu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>