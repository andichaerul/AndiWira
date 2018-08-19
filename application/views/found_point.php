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
	$gen[] = $row->Latitude.$koma.$row->Longitude;
	$PointNameX[] = $row->PointName;
}
for ($x = 0; $x < $_GET['max_populasi']; $x++) {
	$kromosom[$x] = rand(5,$_GET['kromosom']);
    $random_keys[$x]=array_rand($gen,$kromosom[$x]);
}
//echo "<pre>"; 
//print_r($random_keys);
//echo "</pre>";
for ($x = 0; $x < $_GET['max_populasi']; $x++) {
    for ($y = 0; $y < count($random_keys[$x]); $y++) {
    $dataprint[$x][$y] = $gen[$random_keys[$x][$y]];
    $pointprint[$x][$y] = $PointNameX[$random_keys[$x][$y]];
	} 
}

//echo "<pre>"; 
//print_r($dataprint);
//echo "</pre>";
for ($x = 0; $x < $_GET['max_populasi']; $x++) {
    $ruru[$x] = join("|",$dataprint[$x]);
    $url2[$x] = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial%20&origins='.$ruru[$x].'&destinations='.$ruru[$x].'&key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs';
	$JSON2[$x] = file_get_contents($url2[$x]);

$data2[$x] = json_decode($JSON2[$x],true); 
echo "<pre>";
//print_r($data2[$x]['rows']);
echo "</pre>";

for ($y = 0; $y < count($data2[$x]['rows']); $y++) {
	echo "<pre>";
//    print_r($data2[$x]['rows'][$y]['elements']);
    echo "</pre>";
for ($k = 0; $k < count($data2[$x]['rows'][$y]['elements']); $k++) {
	echo "<pre>";
//    print_r($data2[$x]['rows'][$y]['elements'][$k]['distance']['value']);
    $valuedistance[$x][$y] = $data2[$x]['rows'][$y]['elements'][$k]['distance']['value'];
    echo "</pre>";
}
}
}
for ($x = 0; $x < $_GET['max_populasi']; $x++) {
    $a[$x]=$valuedistance[$x];
	$sum[$x] = array_sum($a[$x]);
} 
echo "<pre>";
$lala = (min($sum));
$min1 = array_search($lala,$sum);
//print_r($lala);
if (($key = array_search($lala, $sum)) !== false) {
    unset($sum[$key]);
}
$lala1 = (min($sum));

//print_r($lala1);
echo "Populasi Awal Yang Dibangkitkan<br>";
print_r($pointprint); 
echo "</pre>";
echo "<pre>";
$min2 = array_search($lala1,$sum);
//echo "".$min1."".$min2."";
echo "</pre>";
?>
<?php
echo "<pre>";
echo "Dua Kromosom yang terbaik adalah ".$min1." & ".$min2."<br>";
print_r($pointprint[$min1]);
print_r($pointprint[$min2]);
echo "<pre>";
?>
