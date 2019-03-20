<nav class="navbar navbar-default navbar-inverse">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Rozwiń nawigację</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <?php
            if(isset($_SESSION['id']))
            {
                $_nav = $this->loadModel('navigation_model');
                $_nav->setLinks();
                $_nav->renderNavigation();
            }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if(Permissions::checkPermission('settings')) echo '<li><a href="/settings/review"><i class="fa fa-fw fa-wrench"></i>Ustawienia</a></li>'; ?>
            <li style="margin-right: 15px;">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-sm navbar-btn" >
                        <i class="fa fa-fw fa-user"></i><?php echo $_SESSION['user']; ?>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm navbar-btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="border-radius: 0px; margin-top: 0px;" role="menu">
                        <li><a href="/users/edit_profil/"><i class="fa fa-fw fa-pencil"></i>Edytuj profil</a></li>
                        <li><div class="divider"></div></li>
                        <li><a href="/users/log_out"><i class="fa fa-fw fa-sign-out"></i>Wyloguj</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>