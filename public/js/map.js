/******************************************/
/* Custom Google maps handling */
/******************************************/            

var mapStyles = [{featureType:'road',elementType:'all',stylers:[{hue:'#d7ebef'},{saturation:-5},{lightness:54},{visibility:'on'}]},{featureType:'landscape',elementType:'all',stylers:[{hue:'#eceae6'},{saturation:-49},{lightness:22},{visibility:'on'}]},{featureType:'poi.park',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-81},{lightness:34},{visibility:'on'}]},{featureType:'poi.medical',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-80},{lightness:-2},{visibility:'on'}]},{featureType:'poi.school',elementType:'all',stylers:[{hue:'#c8c6c3'},{saturation:-91},{lightness:-7},{visibility:'on'}]},{featureType:'landscape.natural',elementType:'all',stylers:[{hue:'#c8c6c3'},{saturation:-71},{lightness:-18},{visibility:'on'}]},{featureType:'road.highway',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-92},{lightness:60},{visibility:'on'}]},{featureType:'poi',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-81},{lightness:34},{visibility:'on'}]},{featureType:'road.arterial',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-92},{lightness:37},{visibility:'on'}]},{featureType:'transit',elementType:'geometry',stylers:[{hue:'#c8c6c3'},{saturation:4},{lightness:10},{visibility:'on'}]}];

var map;
var lastInfoWindow;


function initialize(div_id,mapLocation,z,bMarker){
    // Get longitude and latitude
    var _latitude=mapLocation.lat();
    var _longitude=mapLocation.lng();
    // Create graph
    var mapCanvas = document.getElementById(div_id);
    var mapOptions = {
      center: new google.maps.LatLng(_latitude,_longitude),
      zoom: z,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map= new google.maps.Map(mapCanvas,mapOptions);
    // Add styles           
    map.set('styles',mapStyles);
    // Add marker
    if(bMarker){
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(_latitude,_longitude),
        map: map,
        icon: '/img/marker.png'
      });         
    }
}    

function drawMap(div_id,sAddress,z,bMarker){
    var geocoder= new google.maps.Geocoder();
    geocoder.geocode({'address':sAddress},function(results,status){
        if(status==google.maps.GeocoderStatus.OK){
            initialize(div_id,results[0].geometry.location,z,bMarker);
        }else return null;               
    });
}

function addMArker(sAddress,clas,type,stat,username,dat,id){
    var geocoder= new google.maps.Geocoder();
    geocoder.geocode({'address':sAddress},function(results,status){
        if(status==google.maps.GeocoderStatus.OK){
      
          var _latitude=results[0].geometry.location.lat();
          var _longitude=results[0].geometry.location.lng();


          var contentString=sAddress;
          var infowindow = new google.maps.InfoWindow({
            content: '<b>'+sAddress+'</b><br>Rerported by '+username+' on '+dat+'.<br><span style="color:#990000">'+clas+'</span> - <span style="color:#009900">'+type+'</span><br><br>This violation is in the stage <span style="color:#000088">'+stat+'</span>.<br><br>Check more <a href="http://app.buildingviolation.com/violation/'+id+'">here</a>.'
          });

          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(_latitude,_longitude),
            map: map,
            icon: '/img/marker.png'
          });       

          marker.addListener('click', function() {
            if(lastInfoWindow) lastInfoWindow.close();

            infowindow.open(map, marker);
            lastInfoWindow=infowindow;
          });            

        }else return null;               
    });
}

