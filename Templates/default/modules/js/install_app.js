//$.noConflict();

$(document).ready(function() {

    $('#pass').mouseover(function() {
        $('#pass').prop("type","text");
    });
    $('#pass').mouseout(function() {
        $('#pass').prop("type","password");
    });

    var element = document.getElementById('results');
    element.scrollTop = element.scrollHeight;
});