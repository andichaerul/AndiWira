<?php
// Resource Dari database
foreach ($found_point as $row) 
	{
		$point[] = $row->PointName;
		$Longitude[] = $row->Longitude;
		$Latitude[] = $row->Latitude;
		$ID[] = $row->PointID;
	}

//Pencarian Point Start
function point_start($dari, $tujuan)
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
	$distancereport[$x] = point_start($kordinatedari,$kordinatetujuan[$x]);
}
//print_r($kordinatetujuan);
//pemanggilan fungsi
echo "<pre>";
print_r(array_keys($distancereport,min($distancereport)));
$PointStart = array_keys($distancereport,min($distancereport));
echo "</pre>";

// Pencarian Point Tujuan
function point_tujuan($dari, $tujuan)
{
$url = 'https://api.mapbox.com/directions-matrix/v1/mapbox/driving/'.$dari.';'.$tujuan.'?sources=1&annotations=distance&access_token=pk.eyJ1IjoiYW5kaWNoYWVydWw4NSIsImEiOiJjamxhZDB1bWU0MzY4M3dxdGJsbmxqenZxIn0.pOPzmIUQmOrjh1on8-Ytow';
$JSON = file_get_contents($url);
// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;
// You can decode it to process it in PHP
$data = json_decode($JSON,true);
return $data['distances']['0']['0'];
}
$kordinatedari = $_GET['tujuan'];
$koma = ",";
for ($x = 0; $x < count($point); $x++) {
    $kordinatetujuan[$x] = $Longitude[$x].$koma.$Latitude[$x];
	$distancereport1[$x] = point_tujuan($kordinatedari,$kordinatetujuan[$x]);
}
//print_r($kordinatetujuan);
//pemanggilan fungsi
echo "<pre>";
print_r(array_keys($distancereport1,min($distancereport1)));
$PointFinish = array_keys($distancereport1,min($distancereport1));
echo "</pre>";

//Pembangkitan Populasi Awal
for ($x = 0; $x < $_GET['max_pop']; $x++) {
    shuffle($ID);
    $datapopulasi[] = array_slice($ID, 0, rand(3,count($ID)));
    $pisah[] = array_search($PointFinish['0'],$datapopulasi[$x]);
    $populasi[] = array_slice($datapopulasi[$x],0, $pisah[$x]);
    $merge[] = array_merge($PointStart,$populasi[$x]);
    $result[] = array_unique($merge[$x]);
    if (count($result[$x]) > "3") {
    $hasiltrue[] = array_merge($result[$x],$PointFinish);
	}


} 
//for ($x = 0; $x < count($datapopulasi); $x++) {
    
    //$populasi[] = array_slice($data[$x],0, $pisah[$x]);
    //$merge[] = array_merge($PointStart,$populasi[$x]);
    //$result[] = array_unique($merge[$x]);

//} 
echo "<pre>";
//print_r($datapopulasi);
print_r($hasiltrue);
echo "</pre>";
?>
