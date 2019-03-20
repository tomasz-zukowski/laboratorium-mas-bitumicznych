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
                <div class="col-sm-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-list"></i> Lista linków nawigacyjnych
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-hover">
                                <thead>
                                    <th style="width: 25%;" colspan="2"><i class="fa fa-link"></i> Nazwa linku</th>
                                    <th style="width: 35%;">Opis</th>
                                    <th style="width: 25%;">Lokalizacja</th>
                                    <th class="text-center">Off/On</th>
                                </thead>
                                <?php
                                if($links = $this->get('links_list'))
                                {
                                    foreach($links as $link)
                                    {
                                        if($link['_parent']==0)
                                        {
                                            echo "<tr>";
                                            echo "<td colspan='2'><a href='/navigation/edit_link/".$link['id']."'>".$link['link']."</a></td>";
                                            echo "<td>".$link['description']."</td>";
                                            echo "<td>".$link['location']."</td>";
                                            echo ($link['_active']==1) ? '<td class="text-center"><i class="fa fa-toggle-on"></i></td>' : '<td class="text-center"><i class="fa fa-toggle-off"></i></td>';
                                            echo "</tr>";

                                            foreach($links as $link2)
                                            {
                                                if($link2['_parent']==$link['id'])
                                                {
                                                    echo "<tr><td><i class='fa fa-angle-up'></i> </td>";
                                                    echo "<td><a href='/navigation/edit_link/" . $link2['id'] . "'>" . $link2['link'] . "</a></td>";
                                                    echo "<td>" . $link2['description'] . "</td>";
                                                    echo "<td>" . $link2['location'] . "</td>";
                                                    echo ($link2['_active'] == 1) ? '<td class="text-center"><i class="fa fa-toggle-on"></i></td>' : '<td class="text-center"><i class="fa fa-toggle-off"></i></td>';
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    }
                                }
                                else
                                {
                                    echo "<tr><td class='text-center'>Brak zarejestrowanych linków.</td></tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <?php
                    if(Permissions::checkPermission('navigation_ link_new'))
                    {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus"></i> Nowy link
                            </div>
                            <div class="panel-body">
                                <form action="<?php echo $_this_path; ?>" method="POST">

                                    <label>Nazwa linku</label>

                                    <div class="form-group <?php echo $this->get('form_errors', 'name', 'class'); ?>">
                                        <input type="text" class="form-control" name="name"
                                               value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ''; ?>"
                                               placeholder="Nazwa wyświetlana" required />
                                    </div>
                                    <a class="help-block"><?php echo $this->get('form_errors', 'name', 'error_msg'); ?></a>

                                    <label>Opis</label>

                                    <div
                                        class="form-group <?php echo $this->get('form_errors', 'description', 'class'); ?>">
                                        <input type="text" class="form-control" name="description"
                                               value="<?php echo (isset($_POST['description'])) ? $_POST['description'] : ''; ?>"
                                               placeholder="Opis linku" />
                                    </div>
                                    <a class="help-block"><?php echo $this->get('form_errors', 'description', 'error_msg'); ?></a>

                                    <label>Lokalizacja</label>

                                    <div
                                        class="form-group <?php echo $this->get('form_errors', 'localization', 'class'); ?>">
                                        <input type="text" class="form-control" name="localization"
                                               value="<?php echo (isset($_POST['localization'])) ? $_POST['localization'] : ''; ?>"
                                               placeholder="Lokalizacja: kontroler/akcja" required />
                                    </div>
                                    <a class="help-block"><?php echo $this->get('form_errors', 'localization', 'error_msg'); ?></a>

                                    <label>Wymagane uprawnienie</label>

                                    <div
                                        class="form-group <?php echo $this->get('form_errors', 'permission', 'class'); ?>">
                                        <select name="permission" class="form-control">
                                            <option value="0">Brak uprawnienia</option>
                                            <?php
                                            foreach($this->get('permissions') as $permission)
                                            {
                                                echo "<option value='" . $permission['id'] . "'>" . $permission['right_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <a class="help-block"><?php echo $this->get('form_errors', 'permission', 'error_msg'); ?></a>

                                    <label>Rodzic</label>

                                    <div class="form-group <?php echo $this->get('form_errors', 'parent', 'class'); ?>">
                                        <select name="parent" class="form-control">
                                            <option value="0">Brak rodzica</option>
                                            <?php
                                            foreach($this->get('parents') as $parent)
                                            {
                                                echo "<option value='" . $parent['id'] . "'>" . $parent['link'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <a class="help-block"><?php echo $this->get('form_errors', 'parent', 'error_msg'); ?></a>

                                    <label>Pozycja</label>

                                    <div
                                        class="form-group <?php echo $this->get('form-errors', 'possition', 'class'); ?>">
                                        <input type="number" class="form-control" name="possition" min="1"
                                               value="<?php echo (isset($_POST['possition'])) ? $_POST['possition'] : '1'; ?>"
                                               max="15" />
                                    </div>

                                    <div style="width: 100%;" class="text-right">
                                        <br />
                                        <button class="btn btn-primary btn-sm" type="submit">Dodaj link <i
                                                class="fa fa-arrow-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>