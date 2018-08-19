<!DOCTYPE html>
<html>
  <head>
    <title>Custom Markers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <?php echo "
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: new google.maps.LatLng(".$_GET['dari']."),
          mapTypeId: 'roadmap'
        });

        var iconBase = '".base_url('img/')."';
        var icons = {
          dari: {
            icon: iconBase + 'dari.png'
          },
          tujuan: {
            icon: iconBase + 'tujuan.png'
          }
        };

        var features = [
          {
            position: new google.maps.LatLng(".$_GET['dari']."),
            type: 'dari'
          }, 
          {
            position: new google.maps.LatLng(".$_GET['tujuan']."),
            type: 'tujuan'
          }, 
        ];

        // Create markers.
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });
      }
    </script>"
    ?>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs&callback=initMap">
    </script>
  </body>
</html>