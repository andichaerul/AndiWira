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
echo"<pre>";
print_r($PointName[$KeyDistanceMin['0']]);
echo"</pre>";
echo"<pre>";
//print_r($data['rows']['0']['elements']);
echo"</pre>";
?> 
<?php
$url1 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$_GET['tujuan'].'&destinations='.$RenderListCordinate.'&key=AIzaSyBHW1caUelglRxZTENPSzbdJaupH9MntFs';
$JSON1 = file_get_contents($url1);
// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;
// You can decode it to process it in PHP
$data1 = json_decode($JSON1,true);
for ($x = 0; $x < count($data1['rows']['0']['elements']); $x++) {
    $HitungJarak1[$x] = $data1['rows']['0']['elements'][$x]['distance']['value'];
}
asort($HitungJarak1,true);
//print_r(array_keys($HitungJarak));
$KeyDistanceMin1 = (array_keys($HitungJarak1));



echo"<pre>";
print_r($PointName[$KeyDistanceMin1['0']]);
echo"</pre>";
?>
<?php 
//echo"<pre>";
//	print_r($PointName);
//echo"</pre>";


for ($x = 0; $x < $_GET['max_populasi']; $x++) {
	$keys = array_keys($PointName);
    shuffle($keys);
	$populasi[$x] = array_slice($keys, rand(0,3),rand(5,10));
    
}
echo"<pre>";
print_r($populasi);
echo"</pre>";
?>

