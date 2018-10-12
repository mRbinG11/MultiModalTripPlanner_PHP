<?php
$initial = curl_init();

curl_setopt($initial, CURLOPT_URL, "https://api.uber.com/v1.2/estimates/price?start_latitude=12.9165757&start_longitude=77.6101163&end_latitude=12.9614709&end_longitude=77.5746009");
curl_setopt($initial, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($initial, CURLOPT_CUSTOMREQUEST, "GET");


$res = array();
$res[] = "Authorization: Token 5ay12-tO8WAJY9HZB0IDyYZfe3EPhf6J7cL6KfLB";
$res[] = "Accept-Language: en_US";
$res[] = "Content-Type: application/json";
curl_setopt($initial, CURLOPT_HTTPHEADER, $res);

$res = curl_exec($initial);
if (curl_errno($initial)) {
    echo 'Error:' . curl_error($initial);
}
curl_close ($initial);
$result = array();
$result = json_decode($res,true);
print_r($result['prices'][3]);
?>