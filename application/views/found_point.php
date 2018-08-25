<?php
$my_array = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");

for ($x = 0; $x < $_GET['max_pop']; $x++) {
    shuffle($my_array);
    $data[] = array_slice($my_array, 0, rand(3,count($my_array)));
} 
echo "<pre>";
print_r($data);
echo "</pre>";
?>


<?php
  if ($data['1']['0'] <> $data['2']['0']) {
    // mencari potongan data pertama
    $findcut = array_search($data['2']['0'+'1'],$data['1']);
    echo array_search($data['2']['0'+'1'],$data['1']);
    //print_r(array_slice($data['1'], 0 , $findcut)); 
    $child01 = array_slice($data['1'], 0 , $findcut);
    //print_r(array_slice($data['2'], 1 , count($data['2'])));
    $child02 = array_slice($data['2'], 1 , count($data['2']));
    $stillsame = array_merge($child01,$child02);
    // Anak Pertama
    echo "<pre>";
    print_r(array_unique($stillsame));
    echo "</pre>";
    $findcut1 = array_search($data['1'][$findcut],$data['2']);
    $child11 = array_slice($data['2'], 0 , $findcut1);
    $child12 = array_slice($data['1'], $findcut+1, count($data['1']));
    $stillsame1 = array_merge($child11,$child12);
    echo "<pre>";
    print_r(array_unique($stillsame1));
    echo "</pre>";

}
?>
<?php
//pembuatan fungsi
function perkalian($data1, $data2, $data3, $data4, $data5)
{
if ($data1 <> $data2) {
    // mencari potongan data pertama
    $findcut = array_search($data3,$data4);
    //echo array_search($data['2']['0'+'1'],$data['1']);
    //print_r(array_slice($data['1'], 0 , $findcut)); 
    $child01 = array_slice($data4, 0 , $findcut);
    //print_r(array_slice($data['2'], 1 , count($data['2'])));
    $child02 = array_slice($data5, 1 , count($data5));
    $stillsame = array_merge($child01,$child02);
    // Anak Pertama
    //echo "<pre>";
    $result['1'] = array_unique($stillsame);
    //echo "</pre>";
    $findcut1 = array_search($data4[$findcut],$data5);
    $child11 = array_slice($data5, 0 , $findcut1);
    $child12 = array_slice($data4, $findcut+1, count($data4));
    $stillsame1 = array_merge($child11,$child12);
    //echo "<pre>";
    $result['2'] = array_unique($stillsame1);
    //echo "</pre>";
    return $result;
}
}
//pemanggilan fungsi
echo "<pre>";
print_r(perkalian($data['1']['0'],$data['2']['0'],$data['2']['0'+'1'],$data['1'],$data['2']));
echo "</pre>";

?>