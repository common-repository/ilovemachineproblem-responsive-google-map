<?php 
    $ilmp_address = json_encode(get_option('ilmp_address'));
    $ilmp_title = json_encode(get_option('ilmp_title'));
    $ilmp_addinfo = json_encode(get_option('ilmp_addinfo'));
    $ilmp_lat = json_encode(get_option('ilmp_lat'));
    $ilmp_lng = json_encode(get_option('ilmp_lng'));
    $ilmp_zoom = json_encode(get_option('ilmp_zoom'));
    $ilmp_ptc = json_encode(get_option('ilmp_ptc'));
    $ilmp_ptcs = json_encode(get_option('ilmp_ptcs'));
    $ilmp_maptype = json_encode(get_option('ilmp_maptype'));
?>

<script type="text/javascript">
var geocoder;
var map;
var ilmpAddress = <?php echo $ilmp_address ?>;
var ilmpTitle   = <?php echo $ilmp_title ?>;
var ilmpAddInfo = <?php echo $ilmp_addinfo ?>;
var ilmpLat     = <?php echo $ilmp_lat ?>;
var ilmpLng     = <?php echo $ilmp_lng ?>;
var ilmpZoom    = parseInt(<?php echo $ilmp_zoom ?>);
var ilmpPtc     = <?php echo $ilmp_ptc ?>;
var ilmpPtcs    = <?php echo $ilmp_ptcs ?>;
var ilmpMapType = <?php echo $ilmp_maptype ?>;
var ilmpContent = '<div id="ilmp-content"><h1 class="ilmp-heading">' + ilmpTitle + '</h1><p>' + ilmpAddress;

if(ilmpAddInfo == ""){
    ilmpContent += '</p></div>';
} else{
    ilmpContent += '<br>' + ilmpAddInfo + '</p></div>';
}

initialize();
 
function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(ilmpLat, ilmpLng);
    var myOptions = {
        zoom: ilmpZoom,
        center: latlng,
        mapTypeControl: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        navigationControl: true,
        mapTypeId: ilmpMapType
    };
    map = new google.maps.Map(document.getElementById("ilmp-map-canvas"), myOptions);
    if (geocoder) {
        geocoder.geocode( { 'address': ilmpAddress}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                    map.setCenter(results[0].geometry.location);
                    
                    var infowindow = new google.maps.InfoWindow({
                        content: ilmpContent,
                        size: new google.maps.Size(50, 150)
                    });

                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map, 
                        title: ilmpTitle
                    });

                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker);
                    });

                    google.maps.event.addDomListener(window, 'resize', moveToCenter);
                    google.maps.event.addDomListener(window, 'zoom_changed', moveToCenter);
                    google.maps.event.addDomListener(map, 'zoom_changed', function (){
                        infowindow.close();
                        setTimeout(function(){
                            moveToCenter()
                        }, ilmpPtc);
                    });

                    function moveToCenter(){
                        infowindow.close();
                        map.setCenter(results[0].geometry.location);
                    }

                } else {
                    //alert("No results found");
                }
            } else {
                //alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }
}

</script>