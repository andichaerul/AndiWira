<style>
.marker {
    display: block;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    padding: 0;
}
</style>

<div id='map'></div>

<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiYW5kaWNoYWVydWw4NSIsImEiOiJjamxhZDB1bWU0MzY4M3dxdGJsbmxqenZxIn0.pOPzmIUQmOrjh1on8-Ytow';
var geojson = {
    "type": "FeatureCollection",
    "features": [
        {
            "type": "Feature",
            "properties": {
                "message": "Foo",
                "iconSize": [32, 32],
                "imgname":"dari.png"
            },
            "geometry": {
                "type": "Point",
                "coordinates": [
                    <?php echo "".$_GET['dari']."" ?>
                ]
            }
        },
         {
            "type": "Feature",
            "properties": {
                "message": "Bar",
                "iconSize": [32, 32],
                "imgname":"tujuan.png"
            },
            "geometry": {
                "type": "Point",
                "coordinates": [
                    <?php echo "".$_GET['tujuan']."" ?>
                ]
            }
        },
        
        
    ]
};

var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v9',
    center: [<?php echo "".$_GET['dari']."" ?>],
    zoom: 12
});

// add markers to map
geojson.features.forEach(function(marker) {
    // create a DOM element for the marker
    var el = document.createElement('div');
    el.className = 'marker';
 // el.style.backgroundImage = 'url(https://placekitten.com/g/' + marker.properties.iconSize.join('/') + '/)';
    el.style.backgroundImage = 'url(http://localhost/AndiWira/img/' + marker.properties.imgname + '';
    el.style.width = marker.properties.iconSize[0] + 'px';
    el.style.height = marker.properties.iconSize[1] + 'px';

    el.addEventListener('click', function() {
        window.alert(marker.properties.message);
    });

    // add marker to map
    new mapboxgl.Marker(el)
        .setLngLat(marker.geometry.coordinates)
        .addTo(map);
});
</script>