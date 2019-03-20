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
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-6">
                                    <i class="fa fa-link"></i> Edycja linku nawigacyjnego
                                </div>
                                <div class="col-sm-6 text-right">
                                    <?php
                                    if(Permissions::checkPermission('navigation_links_list')) echo '<a href="/navigation/links_list"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a> ';
                                    if(Permissions::checkPermission('navigation_link_delete'))
                                    {
                                        if($this->get('is_parent')!=false)
                                        {
                                            echo '<button class="btn btn-xs btn-danger popover-btn" data-container="body" data-toggle="popover" data-placement="right" data-content="Nie możesz usunąć linku, który zawiera elementy podrzędne!" data-trigger="focus"><i class="fa fa-trash-o"></i> usuń</button> ';
                                        }
                                        else
                                        {
                                            echo '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o"></i> usuń</button> ';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_this_path; ?>" method="POST">
                                <input type="hidden" name="id" value="<?php echo $this->get('link','id'); ?>" />
                                <table class="table">
                                    <tr>
                                        <td style="width: 50%;">
                                            <label>Nazwa linku</label>
                                            <div class="form-group <?php echo $this->get('form_errors','name','class'); ?>">
                                                <input type="text" class="form-control" name="name" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : $this->get('link','link'); ?>" placeholder="Nazwa wyświetlana" required />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','name','error_msg'); ?></a>
                                        </td>
                                        <td style="width: 50%;">
                                            <label>Opis</label>
                                            <div class="form-group <?php echo $this->get('form_errors','description','class'); ?>">
                                                <input type="text" class="form-control" name="description" value="<?php echo (isset($_POST['description'])) ? $_POST['description'] : $this->get('link','description'); ?>" placeholder="Opis linku" />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','description','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Lokalizacja</label>
                                            <div class="form-group <?php echo $this->get('form_errors','localization','class'); ?>">
                                                <input type="text" class="form-control" name="localization" value="<?php echo (isset($_POST['localization'])) ? $_POST['localization'] : $this->get('link','location'); ?>" placeholder="Nazwa wyświetlana" required />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','localization','error_msg'); ?></a>
                                        </td>
                                        <td>
                                            <label>Wymagane uprawnienie</label>
                                            <div class="form-group <?php echo $this->get('form_errors','permission','class'); ?>">
                                                <select name="permission" class="form-control">
                                                    <option value="0">Brak uprawnienia</option>
                                                    <?php
                                                    foreach($this->get('permissions') as $permission)
                                                    {
                                                        if($permission['id']==$this->get('link','_permission'))
                                                        {
                                                            echo "<option value='".$permission['id']."' selected>".$permission['right_name']."</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='".$permission['id']."'>".$permission['right_name']."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','permission','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Rodzic</label>
                                            <div class="form-group <?php echo $this->get('form_errors','parent','class'); ?>">
                                                <select name="parent" class="form-control" <?php echo ($this->get('is_parent')!=false) ? 'disabled' : ''; ?>>
                                                    <option value="0">Brak rodzica</option>
                                                    <?php
                                                    foreach($this->get('parents') as $parent)
                                                    {
                                                        if($parent['id']==$this->get('link','_parent'))
                                                        {
                                                            echo "<option value='".$parent['id']."' selected>".$parent['link']."</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='".$parent['id']."'>".$parent['link']."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','parent','error_msg'); ?></a>
                                        </td>
                                        <td>
                                            <label>Pozycja</label>
                                            <div class="form-group <?php echo $this->get('form-errors','possition','class'); ?>">
                                                <input type="number" class="form-control" name="possition" min="0" value="<?php echo (isset($_POST['possition'])) ? $_POST['possition'] : $this->get('link','_possition'); ?>" max="15" />
                                            </div>

                                            <label>Dostępność</label>
                                            <div class="form-group">
                                                <select name="active" class="form-control">
                                                    <?php
                                                    if($this->get('link','_active')==1)
                                                        $on = 'selected';
                                                    else
                                                        $off = 'selected';
                                                    echo '<option value="1" '.$on.'>Włączony \\ On</option>';
                                                    echo '<option value="0" '.$off.'>Wyłączony \\ Off</option>';
                                                    ?>
                                                </select>
                                            </div>

                                            <div style="width: 100%;" class="text-right">
                                                <br /><button class="btn btn-primary btn-sm" type="submit">Zapisz zmiany <i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
    </body>
</html>