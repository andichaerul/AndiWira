<form method="get" action="distance_report" target="_blank">
	<select name="dari">
		<?php foreach($distance_report as $row): ?>
			<option value="<?php echo "".$row->Longitude.",".$row->Latitude."" ?>"><?php echo "".$row->PointName."" ?></option>
        <?php endforeach; ?>
	</select>
	<button type="submit">Lihat Jarak</button>
</form>
<!-- Pencarian Jarak -->
<?php
foreach ($distance_report as $row) 
	{
		$point[] = $row->PointName;
		$Longitude[] = $row->Longitude;
		$Latitude[] = $row->Latitude;
	}
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
print_r(json_encode($distancereport));
echo "</pre>";
?>
<!-- Kirim Data -->
<form action="distance_insert" method="GET" target="_blank">
	<select name="dari">
		<?php foreach($distance_report as $row): ?>
			<option value="<?php echo "".$row->PointID."" ?>"><?php echo "".$row->PointName."" ?></option>
        <?php endforeach; ?>
	</select>
	<input type="" name="distance" value="<?php print_r(json_encode($distancereport)) ?>">
	<button type="submit">Kirim ke Database</button>
</form>