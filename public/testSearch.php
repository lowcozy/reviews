<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Places Searchbox</title>
  </head>
  <body>
    <input id="pac-input" style="width: 30%;" class="controls" type="text" placeholder="Search Box">
    <div id="map" style="width: 100%; height:850px;"></div>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 21.0278, lng: 105.8342},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var marker;
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

            if(typeof marker !== "undefined")
            {
              marker.setMap(null);
              marker = null;
            }

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            // Create a new marker
            marker = new google.maps.Marker({
              map: map,
              title: place.name,
              position: place.geometry.location
            });

               //lay gia tri lat lng tu marker
       
              console.log(marker.getPosition().lat());

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

        map.addListener('click', function(event) {
         
         if(typeof marker !== "undefined")
            {
              marker.setMap(null);
              marker = null;
            }

          marker = new google.maps.Marker({
            position: event.latLng,
            map: map
          });

          console.log(event.latLng.lat());

        });


      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNHxKOU7potiYY9ayE1rkAwwR6xlBtxFA&libraries=places&callback=initAutocomplete"
         async defer></script>
  </body>
</html>