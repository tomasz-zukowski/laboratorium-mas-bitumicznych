//$.noConflict();

$(document).ready(function() {
    var counter = 0;
    $("#standard").change(function() {
        var standard = $("#standard");
        counter = 0;
        if(!$("#submit").hasClass('disabled'))
        {
            $("#submit").addClass('disabled')
        }

        if(standard.val()!=0)
        {
            $.ajax({
                type: 'POST',
                url: '/lab/AJAXgetDescriptions',
                dataType: 'json',
                data: {
                    standard : standard.val()
                },
                success: function(json) {
                    if(json!=null) {
                        $("#description").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#description").append('<option value="0">Wybierz</option>');
                        for (i = 0; i < json.length; i++) { //tworzymy optiony
                            $("#description").append('<option value="' + json[i]['id'] + '">' + json[i]['description'] + '</option>');
                        }
                    }
                    else
                    {
                        $("#description").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#description").append('<option value="0">Brak danych</option>');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });

            $.ajax({
                type: 'POST',
                url: '/lab/AJAXgetTypes',
                dataType: 'json',
                data: {
                    standard : standard.val()
                },
                success: function(json) {
                    if(json!=null) {
                        $("#type").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#type").append('<option value="0">Wybierz</option>');
                        for (i = 0; i < json.length; i++) { //tworzymy optiony
                            $("#type").append('<option value="' + json[i]['id'] + '">' + json[i]['type'] + '</option>');
                        }
                    }
                    else
                    {
                        $("#type").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#type").append('<option value="0">Brak danych</option>');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });

            $.ajax({
                type: 'POST',
                url: '/lab/AJAXgetCategories',
                dataType: 'json',
                data: {
                    standard : standard.val()
                },
                success: function(json) {
                    if(json!=null) {
                        $("#categorie").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#categorie").append('<option value="0">Wybierz</option>');
                        for (i = 0; i < json.length; i++) { //tworzymy optiony
                            $("#categorie").append('<option value="' + json[i]['id'] + '">' + json[i]['categorie'] + '</option>');
                        }
                    }
                    else
                    {
                        $("#categorie").empty();//czyscimy drugi selekt ze zdarzeń i optionów
                        $("#categorie").append('<option value="0">Brak danych</option>');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    });

    $("#description").change(function() {
        counter++;
        if(counter>=3)
        {
            $("#submit").removeClass('disabled');
        }
    });

    $("#type").change(function() {
        counter++;
        if(counter>=3)
        {
            $("#submit").removeClass('disabled');
        }
    });

    $("#categorie").change(function() {
        counter++;
        if(counter>=3)
        {
            $("#submit").removeClass('disabled');
        }
    });
});