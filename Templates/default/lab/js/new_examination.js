//$.noConflict();

$(document).ready(function() {
    var counter = 0;
    $("#client").change(function() {
        var client = $("#client");
        counter = 0;
        if(!$("#submit").hasClass('disabled'))
        {
            $("#submit").addClass('disabled')
        }

        if(client.val()!=0)
        {
            $.ajax({
                type: 'POST',
                url: '/lab/AJAXgetClientBuildings',
                dataType: 'json',
                data: {
                    client : client.val()
                },
                success: function(json) {
                    if(json!=null) {
                        $("#client_building").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#client_building").append('<option value="0">Wybierz</option>');
                        for (i = 0; i < json.length; i++) { //tworzymy optiony
                            $("#client_building").append('<option value="' + json[i]['id'] + '">' + json[i]['name'] + '</option>');
                        }
                    }
                    else
                    {
                        $("#client_building").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#client_building").append('<option value="0">Brak danych</option>');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });

            $.ajax({
                type: 'POST',
                url: '/lab/AJAXgetClientContacts',
                dataType: 'json',
                data: {
                    client : client.val()
                },
                success: function(json) {
                    if(json!=null) {
                        $("#client_contact").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#client_contact").append('<option value="0">Wybierz</option>');
                        for (i = 0; i < json.length; i++) { //tworzymy optiony
                            $("#client_contact").append('<option value="' + json[i]['id'] + '">' + json[i]['description'] + '</option>');
                        }
                    }
                    else
                    {
                        $("#client_contact").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#client_contact").append('<option value="0">Brak danych</option>');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    });

    $("#examination_date").change(function() {
        var data = $("#examination_date").val();
        data = data.split("-");

        $.ajax({
            type: 'POST',
            url: '/lab/AJAXgetNumOfExaminationsInDate',
            dataType: 'text',
            data: {
                year: data[0],
                month: data[1] ,
                day: data[2]
            },
            success: function(json) {
                if(json=='true')
                {
                    $("#date_help").text(" Podany termin jest dostepny");
                    $("#date_help").removeClass('text-danger fa fa-ban');
                    $("#date_help").addClass('text-success fa fa-check');
                    $("#submit").removeClass('disabled');
                }
                else
                {
                    $("#date_help").text(" Termin jest już zajęty. Wybierz inny!");
                    $("#date_help").removeClass('text-success fa fa-check');
                    $("#date_help").addClass('text-danger fa fa-ban');
                    $("#submit").addClass('disabled');
                }
            },
            error: function(err) {
                alert(err);
            }
        });
    });

    $("#client_building").change(function() {
        counter++;
        if(counter>=2)
        {
            $("#submit").removeClass('disabled');
        }
    });

    $("#client_contact").change(function() {
        counter++;
        if(counter>=2)
        {
            $("#submit").removeClass('disabled');
        }
    });

    $("#sample_status_yes").click(function() {
        $("#yes_sample").show();
        $("#yes_sample_number").attr('required', true);

        $("#no_sample").hide();
    });

    $("#sample_status_no").click(function() {
        $("#no_sample").show();

        $("#yes_sample").hide();
        $("#yes_sample_number").attr('required', false);
    });

    $("#no_sample_method_collection").click(function() {
        $("#no_sample_collection").show();
        $("#no_sample_collection_date").attr('required', true);
        $("#no_sample_collection_number").attr('required', true);

        $("#no_sample_sending").hide();
        $("#no_sample_sending_number").attr('required', false);
    });

    $("#no_sample_method_sending").click(function() {
        $("#no_sample_sending").show();
        $("#no_sample_sending_number").attr('required', true);

        $("#no_sample_collection").hide();
        $("#no_sample_collection_date").attr('required', false);
        $("#no_sample_collection_number").attr('required', false);
    });
});