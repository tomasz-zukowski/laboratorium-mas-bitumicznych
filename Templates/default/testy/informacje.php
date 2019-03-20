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
                <div class="col-sm-12">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="well">
                        <h3>Kontrahenci</h3>
                        <table class="table table-striped table-condensed" style="height: 250px;">
                            <tr>
                                <td style="min-width: 75px;" align="right" nowrap="nowrap">Nazwa:</td>
                                <td class="hilite" width="100%">ALVO Spółka z o.o. w Mirczu </td>
                            </tr>
                            <tr>
                                <td align="right" nowrap="nowrap">Adres:</td>
                                <td class="hilite" width="100%">, 22-530 MIRCZE</td>
                            </tr>
                            <tr>
                                <td align="right" nowrap="nowrap">NIP:</td>
                                <td class="hilite" width="100%">919-15-03-810</td>
                            </tr>
                            <tr>
                                <td align="right" nowrap="nowrap">Nazwisko:</td>
                                <td class="hilite" width="100%"></td>
                            </tr>
                            <tr>
                                <td align="right" nowrap="nowrap">Imię:</td>
                                <td class="hilite" width="100%"></td>
                            </tr>
                            <tr>
                                <td align="right" nowrap="nowrap">Telefon:</td>
                                <td class="hilite" width="100%">084 651-90-03</td>
                            </tr>
                            <tr>
                                <td align="right" nowrap="nowrap">E-mail:</td>
                                <td class="hilite" width="100%"></td>
                            </tr>
                            <tr>
                                <td align="right" nowrap="nowrap">Lokalizacja</td>
                                <td class="hilite" width="100%"><i style='color: green'>Potwierdzona</i></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="well">
                        <h3>&ensp;</h3>
                        <table class="table table-condensed" style="height: 250px;">
                            <tr>
                                <td style="min-width: 75px;" align="right" nowrap="nowrap">Uwagi:</td>
                                <td class="hilite" width="100%"></td>
                            </tr>
                        </table>
                    </div>
            </div>
        </div>
    </body>
    <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>