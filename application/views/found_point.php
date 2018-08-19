<?php
 foreach ($found_point as $row) {
 	$PointName[] = $row->PointName;
 	$Latitude[] = $row->Latitude;
 	$Longitude[] = $row->Longitude; 
 }
?>
<?php
for ($x = 0; $x < count($PointName); $x++) {
	$koma = ",";
    $carikordinat[] = $Latitude[$x].$koma.$Longitude[$x];
} 
$ListCordinate = join("|",$carikordinat);
?>

<?php
$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial%20&origins='.$_GET['dari'].'&destinations='.$ListCordinate.'&key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs';
$JSON = file_get_contents($url);

// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;

// You can decode it to process it in PHP
$data = json_decode($JSON,true);
//echo "<pre>";
//print_r($data);
//echo "</pre>";
for ($x = 0; $x < count($PointName); $x++) {
    $value[] = $data['rows']['0']['elements'][$x]['distance']['value'];
}
$cari = min($value);   
echo $cari;
$carikordinat = array_search($cari,$value);
echo "
PointName = ".$PointName[$carikordinat]."<br>
Point Cordinate =".$Latitude[$carikordinat].','.$Longitude[$carikordinat]."<br>";
?>
<?php
for ($x = 0; $x < count($PointName); $x++) {
	$koma1 = ",";
    $carikordinat1[] = $Latitude[$x].$koma.$Longitude[$x];
} 
$ListCordinate1 = join("|",$carikordinat1);
?>
<?php
$url1 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial%20&origins='.$_GET['tujuan'].'&destinations='.$ListCordinate1.'&key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs';
$JSON1 = file_get_contents($url1);

// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;

// You can decode it to process it in PHP
$data1 = json_decode($JSON1,true);
//echo "<pre>";
//print_r($data);
//echo "</pre>";
for ($x = 0; $x < count($PointName); $x++) {
    $value1[] = $data1['rows']['0']['elements'][$x]['distance']['value'];
}
$cari1 = min($value1);   
echo $cari1;
$carikordinat1 = array_search($cari1,$value1);
echo "
PointName = ".$PointName[$carikordinat1]."<br>
Point Cordinate =".$Latitude[$carikordinat1].','.$Longitude[$carikordinat1]."<br><br>";
?>

<?php
foreach ($pembangkitan_populasi as $row) {
	$gen[] = $row->PointName;
}
for ($x = 0; $x < $_GET['max_populasi']; $x++) {
	$kromosom[$x] = rand(3,$_GET['kromosom']);
    $random_keys[$x]=array_rand($gen,$kromosom[$x]);
}
//echo "<pre>"; 
//print_r($random_keys);
//echo "</pre>";
for ($x = 0; $x < $_GET['max_populasi']; $x++) {
    for ($y = 0; $y < count($random_keys[$x]); $y++) {
    $dataprint[$x][$y] = $gen[$random_keys[$x][$y]];
	} 
}
echo "<pre>"; 
print_r($dataprint);
echo "</pre>";
?>

