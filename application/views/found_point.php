<?php
 foreach ($found_point as $row) {
 	$PointName[] = $row->PointName;
 	$Latitude[] = $row->Latitude;
 	$Longitude[] = $row->Longitude;
 }
?>
<?php
for ($x = 0; $x < count($PointName); $x++) {
	$koma = ',';
    $ListCordinate[$x] = $Latitude[$x].$koma.$Longitude[$x];

}
$RenderListCordinate = join("|",$ListCordinate);
?>

<?php
$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$_GET['dari'].'&destinations='.$RenderListCordinate.'&key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs';
$JSON = file_get_contents($url);
// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;
// You can decode it to process it in PHP
$data = json_decode($JSON,true);
for ($x = 0; $x < count($data['rows']['0']['elements']); $x++) {
    $HitungJarak[$x] = $data['rows']['0']['elements'][$x]['distance']['value'];
}
asort($HitungJarak,true);
//print_r(array_keys($HitungJarak));
$KeyDistanceMin = (array_keys($HitungJarak));
print_r($PointName[$KeyDistanceMin['0']]);
//echo"<pre>";
//print_r($data['rows']['0']['elements']);
//echo"</pre>";
?> 
<?php
//pembuatan fungsi
function perkalian($DariDanTujuan)
{
 foreach ($found_point as $row) {
 	$PointName[] = $row->PointName;
 	$Latitude[] = $row->Latitude;
 	$Longitude[] = $row->Longitude;
 }	
for ($x = 0; $x < count($PointName); $x++) {
	$koma = ',';
    $ListCordinate[$x] = $Latitude[$x].$koma.$Longitude[$x];

}
$RenderListCordinate = join("|",$ListCordinate);	
$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$DariDanTujuan.'&destinations='.$RenderListCordinate.'&key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs';
$JSON = file_get_contents($url);
$data = json_decode($JSON,true);
for ($x = 0; $x < count($data['rows']['0']['elements']); $x++) {
    $HitungJarak[$x] = $data['rows']['0']['elements'][$x]['distance']['value'];
}
asort($HitungJarak,true);
//print_r(array_keys($HitungJarak));
$KeyDistanceMin = (array_keys($HitungJarak));
$hasil =($PointName[$KeyDistanceMin['0']]);
return $hasil;
}
//pemanggilan fungsi
$hasil=perkalian(4,5);
echo "Perkalian 4 x 5 adalah $hasil";
echo "<br />";
echo "Perkalian 7 x 2 adalah ".perkalian($_GET['dari']);
?>