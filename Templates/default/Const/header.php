<title><?php echo $this->title; ?></title>
<meta charset="utf-8">
<link rel="stylesheet" href="/Templates/default/css/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" href="/Templates/default/css/default.css">
<link rel="stylesheet" href="/Templates/default/css/font-awesome/css/font-awesome.min.css">
<?php
/** sprawdzenie czy plik js dla danego widoku istnieje */
$_js_file_path = "Templates/".$_SESSION['layout']."/".Router::$controller."/js/".view::$rendered_file.".js";
if(is_file($_js_file_path))
{
    ?>
    <script type="text/javascript" src="/Libs/jQuery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/<?php echo $_js_file_path; ?>"></script>
    <?php
}
?>