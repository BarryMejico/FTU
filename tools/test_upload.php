<?php
$ch = curl_init();
$fp = fopen(__DIR__ . '/../public/build/assets/ftu_logo-BdzbYq-M.png', 'r');
$file = new CURLFile(__DIR__ . '/../public/build/assets/ftu_logo-BdzbYq-M.png');
$data = ['code' => '1', 'Profile_Picture' => $file];
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/uploadprofilepicture');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
$res = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if(curl_errno($ch)){
    echo 'ERROR: ' . curl_error($ch) . PHP_EOL;
} else {
    echo 'HTTP CODE: ' . $httpcode . PHP_EOL;
    echo 'BODY:' . PHP_EOL;
    var_dump($res);
}
curl_close($ch);

?>