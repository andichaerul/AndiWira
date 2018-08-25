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
    echo "Have a good day!";
}
?>