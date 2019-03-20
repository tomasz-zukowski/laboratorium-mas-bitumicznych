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
            <div class="row">
                <div class="col-sm12">
                    <ol class="breadcrumb" style="float: left;">
                        <li><a href="#">A</a></li>
                        <li><a href="#">B</a></li>
                        <li><a href="#">C</a></li>
                        <li><a href="#">D</a></li>
                        <li><a href="#">E</a></li>
                        <li><a href="#">F</a></li>
                        <li><a href="#">G</a></li>
                        <li><a href="#">H</a></li>
                        <li><a href="#">I</a></li>
                        <li><a href="#">J</a></li>
                        <li><a href="#">K</a></li>
                        <li><a href="#">L</a></li>
                        <li><a href="#">M</a></li>
                        <li><a href="#">N</a></li>
                        <li><a href="#">O</a></li>
                        <li><a href="#">P</a></li>
                        <li><a href="#">Q</a></li>
                        <li><a href="#">R</a></li>
                        <li><a href="#">S</a></li>
                        <li><a href="#">T</a></li>
                        <li><a href="#">U</a></li>
                        <li><a href="#">V</a></li>
                        <li><a href="#">W</a></li>
                        <li><a href="#">X</a></li>
                        <li><a href="#">Y</a></li>
                        <li><a href="#">Z</a></li>
                    </ol>

                    <form style="float: right;" role="search">
                        <div class="form-group" style="float: left;">
                            <input type="text" class="form-control" placeholder="Szukaj" style="float: left; width: 150px;">
                            <button type="submit" style="float: left;" class="btn btn-default">Wyślij</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Kontrahenci</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>L.p.</td>
                                    <td>nazwa</td>
                                    <td>adres</td>
                                    <td>NIP</td>
                                    <td>Lokalizacja</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="http://cad.streng2.linuxpl.info/crm/details/23">AGRO - BUD Józef Kossakowski</a></td>
                                    <td>ul. Papieża Jana Pawła II 26/40, 18-300 Zambrów</td>
                                    <td>723-000-02-14</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="http://cad.streng2.linuxpl.info/crm/details/23">ALVO Spółka z o.o. w Mirczu </a></td>
                                    <td>, 22-530 MIRCZE</td>
                                    <td>919-15-03-810</td><td align="center"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="http://cad.streng2.linuxpl.info/crm/details/14">F.H.U. "ALEX" Robert Smeraczyński </a></td>
                                    <td>ul. Namysłowska  9/22, 03-455 Warszawa</td>
                                    <td>113-142-21-91</td><td align="center"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><a href="http://cad.streng2.linuxpl.info/crm/details/1268">test test</a></td>
                                    <td>Dębnica 5, 77-300 Człuchów</td>
                                    <td>123123</td><td align="center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>