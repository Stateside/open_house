var apiGeolocationSuccess = function(position) {
    $('#latitud').text( position.coords.latitude);
    $('#longitud').text( position.coords.longitude);
      $.post("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&sensor=false", function (result) {
          for (var i = 0; i < result['results'][0]['address_components'].length; i++) {
              if (result['results'][0]['address_components'][i]['types'][0] == "country") {
                  localStorage.setItem('country', result['results'][0]['address_components'][i]['long_name']);
                  if(result['results'][0]['address_components'][i]['long_name'] != "Costa Rica"){
                    $(location).attr('href', 'https://donaciones.teletoncr.com/');
                  }
              }
          }
      });
  };

  var tryAPIGeolocation = function() {
      $.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyADCWKUxZpfdH_j72InmA67nJXGzEmUxLQ", function(success) {
          apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
    })
    .fail(function(err) {
      console.log("API Geolocation error! \n\n"+err);
    });
  };

  if (localStorage.getItem('country') !== null && localStorage.getItem('country') != "Costa Rica"){
      $(location).attr('href', 'https://donaciones.teletoncr.com/');
    }else{
      tryAPIGeolocation();
    }