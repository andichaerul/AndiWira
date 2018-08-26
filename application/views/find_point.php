<?php foreach ($found_point as $row) 
	{
		$point[] = $row->PointName;
		$Longitude[] = $row->Longitude;
		$Latitude[] = $row->Latitude;
	}
?>



<?php
//pembuatan fungsi
function jarak($dari, $tujuan)
{
$url = 'https://api.mapbox.com/directions-matrix/v1/mapbox/walking/'.$dari.';'.$tujuan.'?sources=1&annotations=distance&access_token=pk.eyJ1IjoiYW5kaWNoYWVydWw4NSIsImEiOiJjamxhZDB1bWU0MzY4M3dxdGJsbmxqenZxIn0.pOPzmIUQmOrjh1on8-Ytow';
$JSON = file_get_contents($url);
// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;
// You can decode it to process it in PHP
$data = json_decode($JSON,true);
return $data['distances']['0']['0'];
}
$kordinatedari = $_GET['dari'];
$koma = ",";
for ($x = 0; $x < count($point); $x++) {
    $kordinatetujuan[$x] = $Longitude[$x].$koma.$Latitude[$x];
	$distancereport[$x] = jarak($kordinatedari,$kordinatetujuan[$x]);
}
//print_r($kordinatetujuan);
//pemanggilan fungsi
echo "<pre>";
print_r($distancereport);
echo "</pre>";
?>
