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

// // Point Start
// $url = 'https://api.mapbox.com/directions-matrix/v1/mapbox/walking/'.$kordinatedari.';'.$tujuan.';'.$kordinatetujuan1.'?sources=0&annotations=distance&access_token=pk.eyJ1IjoiYW5kaWNoYWVydWw4NSIsImEiOiJjamxhZDB1bWU0MzY4M3dxdGJsbmxqenZxIn0.pOPzmIUQmOrjh1on8-Ytow';
// $JSON = file_get_contents($url);
// // echo the JSON (you can echo this to JavaScript to use it there)
// //echo $JSON;
// // You can decode it to process it in PHP
// $data = json_decode($JSON,true);
// for ($x = 1; $x < count($data['distances']['0']); $x++) {
//     $datapoint[] = $data['distances']['0'][$x];
// }
// $PointStart = array_keys($datapoint,min($datapoint));

// // Point Tujuan
// $url1 = 'https://api.mapbox.com/directions-matrix/v1/mapbox/walking/'.$kordinatetujuan1.';'.$tujuan.'?sources=0&annotations=distance&access_token=pk.eyJ1IjoiYW5kaWNoYWVydWw4NSIsImEiOiJjamxhZDB1bWU0MzY4M3dxdGJsbmxqenZxIn0.pOPzmIUQmOrjh1on8-Ytow';
// $JSON1 = file_get_contents($url1);
// // echo the JSON (you can echo this to JavaScript to use it there)
// //echo $JSON;
// // You can decode it to process it in PHP
// $data1 = json_decode($JSON1,true);
// for ($x = 1; $x < count($data1['distances']['0']); $x++) {
//     $datapoint1[] = $data1['distances']['0'][$x];
// }
// $PointFinish = array_keys($datapoint1,min($datapoint1));

//Pembangkitan Populasi Awal
$PointStart = array('1');
$PointFinish = array('5');

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
print_r($truepopulasi);
//print_r($distanceslocal);
//print_r($lala);
echo "</pre>";
error_reporting(0);
//pembuatan fungsi
function hitungjarak($data,$distanceslocal)
{
for ($x = 0; $x < count($data); $x++) {
    for ($y = 0; $y < count($data[$x]); $y++) {

    	$jarak[$x][$y] = $distanceslocal[$data[$x][$y]][$data[$x][$y+1]];
    	
	}
	$totaljarak[] = array_sum($jarak[$x]);
	asort($totaljarak);
}
$orangtua[] = array_slice(array_keys($totaljarak), 0,2); 
return $orangtua;
}
echo "<pre>";
print_r(hitungjarak($truepopulasi,$distanceslocal));
$orangtua[] = hitungjarak($truepopulasi,$distanceslocal);
echo "</pre>";

// pembuatan fuction crossover
//pembuatan fungsi
function perkawinan($parentvar, $childvar)
{
	if ($parentvar <> $childvar) {
		$parent = $parentvar;
		$child  = $childvar;
		$devisi = count($parent) / 2;
		$pointcut = round($devisi);
		$gen[] = array_unique(array_merge(array_slice($parent, 0,$pointcut-1),array_slice($child, $pointcut-1)));
		$gen[] = array_unique(array_merge(array_slice($child, 0,$pointcut-1),array_slice($parent, $pointcut-1)));
		return $gen;
	}
}

echo "<pre>";
echo "Hasil CrossOver";
print_r(perkawinan($truepopulasi[$orangtua['0']['0']['0']],$truepopulasi['1']));
echo "</pre>";
?>

