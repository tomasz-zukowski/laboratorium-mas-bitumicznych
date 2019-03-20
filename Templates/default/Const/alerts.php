<?php
if($_alert_panel = $this->get('_alert_panel'))
{
    if(isset($_alert_panel['alert_time']))
    {
        header("Refresh: ".$_alert_panel['alert_time']."; Url=".$_alert_panel['alert_destination']);
        $spin = true;
    }
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-<?php echo $_alert_panel['class']; ?> alert-dismissable" style="font-size: 17px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                if($_alert_panel['class']=='success')
                    echo '<i class="fa fa-check"></i> ';
                elseif($_alert_panel['class']=='danger')
                    echo '<i class="fa fa-close"></i> ';
                elseif($_alert_panel['class']=='warning')
                    echo '<i class="fa fa-exclamation"></i> ';

                echo $_alert_panel['description'];

                if(isset($spin) && $spin==true)
                {
                    echo '<i class="fa fa-spin fa-spinner" style="margin-left: 20px;"></i>';
                }

                ?>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
if($_prompts = $this->isSetPromptWindow())
{
    foreach($_prompts as $_prompt)
    {
        ?>
        <form method="<?php echo $_prompt['method']; ?>" <?php echo (isset($_prompt['action'])) ? 'action="'.$_prompt['action'].'"' : ''; ?>>
            <div class="modal fade" <?php echo ($_prompt['closeable']==true) ? '' : 'data-backdrop="static" data-keyboard="false"'; ?> id="<?php echo $_prompt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog <?php echo $_prompt['size']; ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <?php
                            if($_prompt['closeable']==true)
                            {
                                echo '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                    class="sr-only">Zamknij</span></button>';
                            }
                            ?>
                            <h4 class="modal-title" id="myModalLabel"><?php echo $_prompt['title']; ?></h4>
                        </div>
                        <div class="modal-body">
                            <?php echo $_prompt['content']; ?>
                        </div>
                        <div class="modal-footer">
                            <?php
                            if($_prompt['closeable']==true || $_prompt['cancel_button']==true)
                            {
                                echo '<button type="button" class="btn btn-'.$_prompt['cencel_button_class'].'" data-dismiss="modal">Anuluj</button>';
                            }
                            if($_prompt['ok_button']==true)
                            {
                                echo '<button type="submit" class="btn btn-'.$_prompt['ok_button_class'].'">OK</button>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php
    }
}
?>