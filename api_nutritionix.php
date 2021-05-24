<?php
//vado ad accedere all'api tramite url
$APP_ID = 'b545a288';
$API_KEY = 'bb8be6710ca37d5963b89eb2e095aa89';

$url ='https://trackapi.nutritionix.com/v2/search/instant?query=';
$curl=curl_init();
$data_query=$_GET['query'];

$data_hedears=array('Content-Type : application/json',
                    'x-app-id :'.$APP_ID,
                    'x-app-key :'.$API_KEY);
curl_setopt($curl,CURLOPT_HTTPHEADER,$data_hedears);
curl_setopt($curl,CURLOPT_URL,$url.$data_query);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$result=curl_exec($curl);
$array=json_decode($result);
$json=json_encode($array);
print_r($json);
return $json;
?>