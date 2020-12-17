<?php
$basePath = dirname(__DIR__);
$baseUrl = 'https://bs.chc.com.tw/api/index?isPostBack=true&area=&useType=&fromMonth=01&endMonth=12&category=&custName=';
$years = [2017,2018,2019,2020];
$cities = ['基隆市', '台北市', '新北市', '宜蘭縣', '新竹市', '新竹縣', '桃園市', '苗栗縣', '台中市', '彰化縣', '南投縣', '嘉義市', '嘉義縣', '雲林縣', '台南市', '高雄市', '屏東縣', '台東縣', '花蓮縣', '金門縣', '連江縣', '澎湖縣'];

$arrContextOptions= array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);
$context = stream_context_create($arrContextOptions);

foreach($years AS $year) {
    foreach($cities AS $city) {
        $rawPath = $basePath . '/raw/' . $city;
        if(!file_exists($rawPath)) {
            mkdir($rawPath, 0777, true);
        }
        $rawFile = $rawPath . '/' . $year . '.html';
        if(!file_exists($rawFile)) {
            $listUrl = "{$baseUrl}&year={$year}&city=" . urlencode($city);
            file_put_contents($rawFile, file_get_contents($listUrl, false, $context));
        }
    }
}