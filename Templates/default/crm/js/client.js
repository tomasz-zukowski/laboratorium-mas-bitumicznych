var geocoder;
var map;
var marker;
var latlng = new google.maps.LatLng(53.397, 9.644);

function initialize() {
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 4,
        center: latlng,
        streetViewControl: false,
        mapTypeControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    codeAddress();
}

function codeAddress() {
    var address = document.getElementById('address').getAttribute("data-address");
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.panTo(results[0].geometry.location);
            map.setZoom(13);
            if( marker != null ) {
                marker.setPosition( results[0].geometry.location );
                updateMarkerPosition( results[0].geometry.location );
            } else {
                marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            }
            document.getElementById('status').innerHTML = '<i class="fa fa-check"></i> Lokalizacja potwierdzona';
        } else {
            map.panTo(latlng);
            map.setZoom(4);
            marker.setPosition(null);
            document.getElementById('status').innerHTML = '<i class="fa fa-times"></i> Nie znaleziono lokalizacji';
        }
    });
}

google.maps.event.addDomListener(window, 'load', initialize);