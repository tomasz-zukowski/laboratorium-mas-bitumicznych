//$.noConflict();

$(document).ready(function() {

    $('#confirmation').modal('show');

    var check_status = false;

    /** wszystykie tabele */
    $("#all_tables").change(function () {
        $("#db_tables").slideToggle('slow',function() {
            $("#db_tables").find('input').each(function() {
                $(this).prop("disabled",true);
            });
        });
    });

    /** zaznaczone tabele */
    $("#selected_tables").change(function () {
        $("#db_tables").slideToggle('slow', function () {
            $("#db_tables").find('input').each(function() {
                $(this).prop("disabled",false);
            });
        });
    });

});