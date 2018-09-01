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
echo "<pre>";
//print_r($distanceslocal);
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
echo "Populasi Awal";
print_r($truepopulasi);
//print_r($distanceslocal);
//print_r($lala);
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
print_r(hitungjarak($truepopulasi,$distanceslocal));
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
		$pointcut = rand(0,count($parent));
		$gen = array_unique(array_merge(array_slice($parent, 0,$pointcut-1),array_slice($child, $pointcut-1)));
		//$gen = array_unique(array_merge(array_slice($child, 0,$pointcut-1),array_slice($parent, $pointcut-1)));
		return $gen;	
		
	}
}
function perkawinan1($parentvar, $childvar)
{
	if ($parentvar <> $childvar) {
		$parent = $parentvar;
		$child  = $childvar;
		//$devisi = count($parent) / 2;
		$pointcut = rand(0,count($parent));
		//$gen = array_unique(array_merge(array_slice($parent, 0,$pointcut-1),array_slice($child, $pointcut-1)));
		$gen = array_unique(array_merge(array_slice($child, 0,$pointcut-1),array_slice($parent, $pointcut-1)));
		return $gen;	
		
	}
}
//START
for ($i=0; $i < count($ortu['0']['key_winner']); $i++) { 
	for ($x=0; $x < count($truepopulasi); $x++) { 
		if ($i <> $x) {
			$truepopulasi1[] = perkawinan($truepopulasi[$ortu['0']['key_winner'][$i]],$truepopulasi[$x]);
			$truepopulasi1[] = perkawinan1($truepopulasi[$ortu['0']['key_winner'][$i]],$truepopulasi[$x]);
		}
	}
}
echo "<pre>";
print_r($truepopulasi1);
echo "</pre>";
// echo "<pre>";
// echo "Hasil CrossOver / GENERASI KE 2";
// print_r($generasi);
// print_r($merge);
// print_r(hitungjarak($generasi,$distanceslocal));
// $orangtua2[] = hitungjarak($generasi,$distanceslocal);
// echo "</pre>";
// for ($x=0; $x < count($orangtua2['0']['0']); $x++) {
// 	for ($y = 0; $y < count($generasi); $y++) {
//     $generasi1[] = perkawinan($generasi[$orangtua['0']['0'][$x]],$generasi[$y]); 
// 	}  	
// }
// echo "<pre>";
// print_r($generasi1);
// print_r(hitungjarak($generasi1,$distanceslocal));
// echo "</pre>";
?>


