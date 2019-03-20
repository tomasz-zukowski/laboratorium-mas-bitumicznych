<!DOCTYPE html>
<html>
<head>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
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
                        <div class="col-sm-12">
                            <i class="fa fa-gear"></i> Ustawienia modułu lab
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <form method="post" action="<?php echo $_this_path; ?>">
                                <label>Maksymalna ilość badań podczas jednego dnia</label>
                                <input type="number" class="form-control" name="tests_per_day" value="<?php echo (isset($_POST['tests_per_day'])) ? $_POST['tests_per_day'] : $this->get('settings','tests_per_day'); ?>" required><br />
                                <input type="submit" class="btn btn-sm btn-primary" style="float: right;" value="Zapisz" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include 'Templates/'.$_SESSION['layout'].'/Const/footer.php'; ?>
</html>