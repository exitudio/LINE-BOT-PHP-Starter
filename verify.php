<?php
/**
 * Created by PhpStorm.
 * User: exit
 * Date: 11/17/16
 * Time: 2:12 AM
 */
$access_token = 'Oim7BDPK584CzkBpu/6GWENT+fUjPFjastMyVTXZtyUMDP5MlOiCnl3IbZSgV8olsZA/F5gVRObhiSlWVb/UzN4/xHFhIH3Et+a8AThijuVnLFFSrwuDY7uiCRgoFweQgMGj6+R97+wnfgksqZkELgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;