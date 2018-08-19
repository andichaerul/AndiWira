<?php
 foreach ($found_point as $row) {
 	$PointName[] = $row->PointName;
 	$Latitude[] = $row->Latitude;
 	$Longitude[] = $row->Longitude;
 }
?>
<?php

for ($x = 0; $x <= 10; $x++) {
    echo "The number is: $x <br>";
}  
?>
<?php
$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial%20&origins=-5.096227,20119.510818%20&destinations=-5.091716,20119.505282|-5.089782,20119.505336|-5.089953,%20119.517063%20&key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs';
$JSON = file_get_contents($url);

// echo the JSON (you can echo this to JavaScript to use it there)
echo $JSON;

// You can decode it to process it in PHP
$data = json_decode($JSON);
var_dump($data);
?>
<?php
//for ($x = 0; $x < count($PointName); $x++) {
//  $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$_GET['dari'].'&destinations='.$Latitude[$x].','.$Longitude[$x].'&key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs';
//  $JSON = file_get_contents($url);

// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;

// You can decode it to process it in PHP
//$data[$x] = json_decode($JSON,true);
//echo "<pre>";
//print_r($Latitude[$x]);
//echo "<br>";
//print_r($Longitude[$x]);
//print_r($data[$x]['rows']['0']['elements']['0']['distance']);
//$nilai[] = $data[$x]['rows']['0']['elements']['0']['distance']['value'];
//echo "</pre>"; 
//}
//echo(min($nilai));
//$cari = min($nilai);  
//echo array_search($cari,$nilai);
//$carikordinat = array_search($cari,$nilai);
//echo "".$PointName[$carikordinat]." ".$Latitude[$carikordinat].','.$Longitude[$carikordinat]."";
?>
