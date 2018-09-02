<?php
// Resource Dari database
foreach ($found_point as $row) 
	{
		$point[] = $row->PointName;
		$Longitude[] = $row->Longitude;
		$Latitude[] = $row->Latitude;
		$ID[] = $row->PointID;
		$distanceslocal[] = json_decode($row->Other); 
	}

$kordinatedari = $_GET['dari'];
$kordinatetujuan1 = $_GET['tujuan'];
$koma = ",";
for ($x = 0; $x < count($point); $x++) {
    $kordinatetujuan[$x] = $Longitude[$x].$koma.$Latitude[$x];
}
$tujuan = join(";",$kordinatetujuan);

// Point Start
$url = 'https://api.mapbox.com/directions-matrix/v1/mapbox/driving/'.$kordinatedari.';'.$tujuan.';'.$kordinatetujuan1.'?sources=0&annotations=distance&access_token=pk.eyJ1IjoiYW5kaWNoYWVydWw4NSIsImEiOiJjamxhZDB1bWU0MzY4M3dxdGJsbmxqenZxIn0.pOPzmIUQmOrjh1on8-Ytow';
$JSON = file_get_contents($url);
// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;
// You can decode it to process it in PHP
$data = json_decode($JSON,true);
for ($x = 1; $x < count($data['distances']['0']); $x++) {
    $datapoint[] = $data['distances']['0'][$x];
}
$PointStart = array_keys($datapoint,min($datapoint));

// Point Tujuan
$url1 = 'https://api.mapbox.com/directions-matrix/v1/mapbox/driving/'.$kordinatetujuan1.';'.$tujuan.'?sources=0&annotations=distance&access_token=pk.eyJ1IjoiYW5kaWNoYWVydWw4NSIsImEiOiJjamxhZDB1bWU0MzY4M3dxdGJsbmxqenZxIn0.pOPzmIUQmOrjh1on8-Ytow';
$JSON1 = file_get_contents($url1);
// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;
// You can decode it to process it in PHP
$data1 = json_decode($JSON1,true);
for ($x = 1; $x < count($data1['distances']['0']); $x++) {
    $datapoint1[] = $data1['distances']['0'][$x];
}
$PointFinish = array_keys($datapoint1,min($datapoint1));

//Pembangkitan Populasi Awal
// $PointStart = array('1');
// $PointFinish = array('8');
echo "<pre>";
////print_r($distanceslocal);
echo "</pre>";
for ($x = 0; $x < $_GET['max_pop']; $x++) {
	shuffle($ID);
	$gabung =array_merge($PointStart,$ID);
	$duplikathilang = array_unique($gabung);
	$potong = array_slice($duplikathilang, 0,array_search($PointFinish['0'], $duplikathilang));
	$populasiawal[] = array_unique(array_merge($potong,$PointFinish));
}
for ($x = 0; $x <count($populasiawal); $x++) {
    if (count($populasiawal[$x]) > 4) {
    	$truepopulasi[] = $populasiawal[$x];
    };
} 
echo "<pre>";
//print_r($truepopulasi);
////print_r($distanceslocal);
////print_r($lala);
echo "</pre>";
//error_reporting(0);
//pembuatan fungsi
function hitungjarak($data,$distanceslocal)
{
	for ($x=0; $x < count($data); $x++) {
		$count[] = count($data[$x])-1; 
		$dari[] = array_slice($data[$x], 0, $count[$x]);
		$tujuan[] = array_slice($data[$x], 1, count($data[$x]));

	  		for ($y=0; $y < $count[$x]; $y++) { 
	  			$jarak[$x][] = $distanceslocal[$dari[$x][$y]][$tujuan[$x][$y]];

	  		}
	  	$sumjarak[] = array_sum($jarak[$x]);	
	  	}
	  	asort($sumjarak);
	  	$orangtua['orangtua'] = array_slice($sumjarak, 0, 2, true);
	  	$keywinner['key_winner'] = array_keys($orangtua['orangtua']);
	  	$windis[] = array_slice($sumjarak, 0, 1, true);
	  	$winner['winner_distances'] = array_slice($sumjarak, 0, 1);
	  	$key[] = array_search($winner['winner_distances'], $sumjarak );
	  	$report[] = array_merge($winner,$orangtua,$keywinner);  	

return $report;
}
echo "<pre>";
//print_r(hitungjarak($truepopulasi,$distanceslocal));
$ortu = hitungjarak($truepopulasi,$distanceslocal);
echo "</pre>";

// pembuatan fuction crossover
//pembuatan fungsi
function perkawinan($parentvar, $childvar)
{
	if ($parentvar <> $childvar) {
		$parent = $parentvar;
		$child  = $childvar;
		//$devisi = count($parent) / 2;
		$pointcut = rand(1,count($child));
		$gen = array_unique(array_merge(array_slice($parent, 0,$pointcut-1),array_slice($child, $pointcut-1)));
		//$gen = array_unique(array_merge(array_slice($child, 0,$pointcut-1),array_slice($parent, $pointcut-1)));
			
	}
	else {
		
		$gen = $parentvar;
	}

	return $gen;
}
function perkawinan1($parentvar, $childvar)
{
	if ($parentvar <> $childvar) {
		$parent = $parentvar;
		$child  = $childvar;
		//$devisi = count($parent) / 2;
		$pointcut = rand(1,count($parent));
		//$gen = array_unique(array_merge(array_slice($parent, 0,$pointcut-1),array_slice($child, $pointcut-1)));
		$gen = array_unique(array_merge(array_slice($child, 0,$pointcut-1),array_slice($parent, $pointcut-1)));
			
	}
	else {
		
		$gen = $parentvar;
	}

	return $gen;
}

//GENERASI KE 2
for ($i=0; $i < count($ortu['0']['key_winner']); $i++) { 
	for ($x=0; $x < count($truepopulasi); $x++) { 
		if ($i <> $x) {
			$truepopulasi1[] = perkawinan($truepopulasi[$ortu['0']['key_winner'][$i]],$truepopulasi[$x]);
			$truepopulasi1[] = perkawinan1($truepopulasi[$ortu['0']['key_winner'][$i]],$truepopulasi[$x]);
		}
	}
} 
echo "<pre>";
//print_r($truepopulasi1);
echo "</pre>";
echo "<pre>";
//print_r(hitungjarak($truepopulasi1,$distanceslocal));
$ortu1 = hitungjarak($truepopulasi1,$distanceslocal);
echo "</pre>";

//GENERASI KE 3
for ($i=0; $i < count($ortu1['0']['key_winner']); $i++) { 
	for ($x=0; $x < count($truepopulasi1); $x++) { 
		if ($i <> $x) {
			$truepopulasi2[] = perkawinan($truepopulasi1[$ortu1['0']['key_winner'][$i]],$truepopulasi1[$x]);
			$truepopulasi2[] = perkawinan1($truepopulasi1[$ortu1['0']['key_winner'][$i]],$truepopulasi1[$x]);
		}
	}
} 
echo "<pre>";
//print_r($truepopulasi2);
echo "</pre>";
echo "<pre>";
//print_r(hitungjarak($truepopulasi2,$distanceslocal));
$ortu2 = hitungjarak($truepopulasi2,$distanceslocal);
echo "</pre>";

//GENERASI KE 4
for ($i=0; $i < count($ortu2['0']['key_winner']); $i++) { 
	for ($x=0; $x < count($truepopulasi2); $x++) { 
		if ($i <> $x) {
			$truepopulasi3[] = perkawinan($truepopulasi2[$ortu2['0']['key_winner'][$i]],$truepopulasi2[$x]);
			$truepopulasi3[] = perkawinan1($truepopulasi2[$ortu2['0']['key_winner'][$i]],$truepopulasi2[$x]);
		}
	}
} 
echo "<pre>";
//print_r($truepopulasi3);
echo "</pre>";
echo "<pre>";
//print_r(hitungjarak($truepopulasi3,$distanceslocal));
$ortu3 = hitungjarak($truepopulasi3,$distanceslocal);
echo "</pre>";

//GENERASI KE 5
for ($i=0; $i < count($ortu3['0']['key_winner']); $i++) { 
	for ($x=0; $x < count($truepopulasi3); $x++) { 
		if ($i <> $x) {
			$truepopulasi4[] = perkawinan($truepopulasi3[$ortu3['0']['key_winner'][$i]],$truepopulasi3[$x]);
			$truepopulasi4[] = perkawinan1($truepopulasi3[$ortu3['0']['key_winner'][$i]],$truepopulasi3[$x]);
		}
	}
} 
echo "<pre>";
//print_r($truepopulasi4);
echo "</pre>";
echo "<pre>";
//print_r(hitungjarak($truepopulasi4,$distanceslocal));
$ortu4 = hitungjarak($truepopulasi4,$distanceslocal);
echo "</pre>";


//GENERASI KE 6
for ($i=0; $i < count($ortu4['0']['key_winner']); $i++) { 
	for ($x=0; $x < count($truepopulasi4); $x++) { 
		if ($i <> $x) {
			$truepopulasi5[] = perkawinan($truepopulasi4[$ortu4['0']['key_winner'][$i]],$truepopulasi4[$x]);
			$truepopulasi5[] = perkawinan1($truepopulasi4[$ortu4['0']['key_winner'][$i]],$truepopulasi4[$x]);
		}
	}
} 
echo "<pre>";
//print_r($truepopulasi5);
echo "</pre>";
echo "<pre>";
////print_r(hitungjarak($truepopulasi5,$distanceslocal));
$ortu5 = hitungjarak($truepopulasi5,$distanceslocal);
////print_r($truepopulasi5[$ortu5['0']['key_winner']['0']]);
$truewinner = array_merge($truepopulasi5[$ortu5['0']['key_winner']['0']]);
//print_r($truewinner);
for ($x=0; $x < count($truewinner) ; $x++) {
	$waypoint11[] = $kordinatetujuan[$truewinner[$x]];
}
$daridirect[] = $_GET['dari'];
$tujuandirect[] = $_GET['tujuan'];
$waypoint[] = array_merge($daridirect,$waypoint11,$tujuandirect);
$arr = count($waypoint['0'])-1;
$from = array_slice($waypoint['0'], 0,$arr);
$to = array_slice($waypoint['0'],1);
for ($x=0; $x < count($from) ; $x++) {
 	$koma1 = ";";
 	$request[] = $from[$x].$koma1.$to[$x];
 }
////print_r($from);
//print_r($);
echo "</pre>";


// //GENERASI KE 7
// for ($i=0; $i < count($ortu5['0']['key_winner']); $i++) { 
// 	for ($x=0; $x < count($truepopulasi5); $x++) { 
// 		if ($i <> $x) {
// 			$truepopulasi6[] = perkawinan($truepopulasi5[$ortu5['0']['key_winner'][$i]],$truepopulasi5[$x]);
// 			$truepopulasi6[] = perkawinan1($truepopulasi5[$ortu5['0']['key_winner'][$i]],$truepopulasi5[$x]);
// 		}
// 	}
// } 
// echo "<pre>";
// //print_r($truepopulasi6);
// echo "</pre>";
// echo "<pre>";
// //print_r(hitungjarak($truepopulasi6,$distanceslocal));
// $ortu6 = hitungjarak($truepopulasi6,$distanceslocal);
// echo "</pre>";

// //GENERASI KE 8
// for ($i=0; $i < count($ortu6['0']['key_winner']); $i++) { 
// 	for ($x=0; $x < count($truepopulasi6); $x++) { 
// 		if ($i <> $x) {
// 			$truepopulasi7[] = perkawinan($truepopulasi6[$ortu6['0']['key_winner'][$i]],$truepopulasi6[$x]);
// 			$truepopulasi7[] = perkawinan1($truepopulasi6[$ortu6['0']['key_winner'][$i]],$truepopulasi6[$x]);
// 		}
// 	}
// } 
// echo "<pre>";
// //print_r($truepopulasi7);
// echo "</pre>";
// echo "<pre>";
// //print_r(hitungjarak($truepopulasi7,$distanceslocal));
// $ortu7 = hitungjarak($truepopulasi7,$distanceslocal);
// echo "</pre>";
for ($x=0; $x < count($request); $x++) {
	$url = 'https://api.mapbox.com/directions/v5/mapbox/driving/'.$request[$x].'.json?access_token=pk.eyJ1IjoiYW5kaWNoYWVydWw4NSIsImEiOiJjamxhZDB1bWU0MzY4M3dxdGJsbmxqenZxIn0.pOPzmIUQmOrjh1on8-Ytow&geometries=geojson';
	$JSON = file_get_contents($url);

	// echo the JSON (you can echo this to JavaScript to use it there)
	//echo $JSON;

	// You can decode it to process it in PHP
	$datapolyline[] = json_decode($JSON,true);
	$gege[] = json_encode($datapolyline[$x]['routes']['0']['geometry']['coordinates']);
	
}
	$centerr = json_encode($datapolyline['0']['routes']['0']['geometry']['coordinates']['0']);
?>

<div id='map1'></div>
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
    <?php

    	for ($x=1; $x < count($waypoint['0'])-1 ; $x++) { 
    		echo "
    		{
            'type': 'Feature',
            'properties': {
                'message': 'Foo',
                'iconSize': [32, 32],
                'imgname':'point".$x.".png'
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [".$waypoint['0'][$x]."
                ]
            }
        },
    		";
    	}
    ?>
        
        
        
    ]
};
var map = new mapboxgl.Map({
    container: 'map1',
    style: 'mapbox://styles/mapbox/streets-v9',
    center: <?php echo "".$centerr."" ?>,
    zoom: 15
});
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
map.on('load', function () {

	<?php for ($x=0; $x < count($gege) ; $x++) { 
		echo "
		map.addLayer({
        'id': 'route".$x."',
        'type': 'line',
        'source': {
            'type': 'geojson',
            'data': {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'type': 'LineString',
                    'coordinates': ".$gege[$x]."
                    
                }
            }
        },
        'layout': {
            'line-join': 'round',
            'line-cap': 'round'
        },
        'paint': {
            'line-color': '#888',
            'line-width': 8
        }
    	});
		";
	} ?>
    
});
</script>


