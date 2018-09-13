<?PHP
function sendMessage() {
    $content      = array(
        "en" => $_GET['kasus'], // JUDUL REPORT 
    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Like",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://yoursite.com"
    ));
    array_push($hashes_array, array(
        "id" => "like-button-2",
        "text" => "Like2",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://yoursite.com"
    ));
    $jsonData = array(
        'app_id' => "0597bf91-87ee-40e5-8928-a82c1e0b83f3",
        'included_segments' => array(
            'All'
        ),
        'data' => array(
            "foo" => "bar",
            "inikordinat" => $_GET['cordinate'],
            "date" => date("l jS \of F Y h:i:s A"),
            "nama" => $_GET['nama'],
            "telp" => $_GET['telepon'],
            "pesan" => $_GET['pesan'],
            "bencana" => $_GET['kasus'], // TITIK KORDINAT
        ),
        'contents' => $content,
        'web_buttons' => $hashes_array
    );
    
    $jsonData = json_encode($jsonData);
    // print("\nJSON sent:\n");
    // print($jsonData);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic NTRmMmU0NWQtNzI5ZC00MDA3LTllZmEtZTJlNTdjN2IwZjQ0'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);
//print_r($data);
$id = $data['id'];
//print_r($id);
echo "Berhasil Mengirim Laporan";
//print("\n\nJSON received:\n");
//print($return);
//print("\n");
?>