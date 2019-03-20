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
                            <i class="fa fa-plus"></i> Edycja kontaktu
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="/crm/client/<?php echo $this->get('client_id'); ?>"><button class="btn btn-xs btn-info"><i class="fa fa-arrow-left"></i> powrót</button></a>
                            <?php
                            if(Permissions::checkPermission('crm_delete_contact'))
                            {
                                echo '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> usuń</button> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="<?php echo $_this_path; ?>" method="POST">
                        <div class="row">
                            <div class="col-sm-7">
                                <table class="table table-responsive">
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Opis kontaktu</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','description','class'); ?>">
                                                <textarea class="form-control" name="description" placeholder="Opis rejestrowanego kontaktu. Imię, nazwisko itp.." required autofocus><?php echo (isset($_POST['description'])) ? $_POST['description'] : $this->get('contact','description'); ?></textarea>
                                                <a class="help-block"><?php echo $this->get('form_errors','description','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Telefon</td>
                                        <td>
                                            <div class="input-group form-inline <?php echo $this->get('form_errors','phone','class'); ?>">
                                                <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                                <input class="form-control" type="text" name="phone" style="width: 100%;" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : $this->get('contact','phone'); ?>" placeholder="Numer telefonu" maxlength="100" />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','phone','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">E-mail</td>
                                        <td>
                                            <div class="input-group form-inline <?php echo $this->get('form_errors','email','class'); ?>">
                                                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                                <input class="form-control" type="email" name="email" style="width: 100%;" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : $this->get('contact','email'); ?>" placeholder="Adres e-mail" maxlength="100" />
                                            </div>
                                            <a class="help-block"><?php echo $this->get('form_errors','email','error_msg'); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%; font-weight: bold;">Uwagi</td>
                                        <td>
                                            <div class="form-group <?php echo $this->get('form_errors','comments','class'); ?>">
                                                <textarea class="form-control" name="comments" placeholder="Uwagi"><?php echo (isset($_POST['comments'])) ? $_POST['comments'] : $this->get('contact','comments'); ?></textarea>
                                                <a class="help-block"><?php echo $this->get('form_errors','comments','error_msg'); ?></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">
                                            <button class="btn btn-primary btn-sm" type="submit">Zapisz zmiany <i class="fa fa-save"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-5">

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