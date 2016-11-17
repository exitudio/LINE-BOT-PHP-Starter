<?php
/**
 * Created by PhpStorm.
 * User: exit
 * Date: 11/17/16
 * Time: 2:12 AM
 */
$access_token = '82xfNIJdgKkKRItOKPUjcP1OHMVvNB7Avy02b3Qjk/g1XzU2rE7llUQTQLmicNmORuhWGq9bCKIG1IsZnIv5LB9RcbAj/B2XfHQ1bb3JCEtLP8C6qbXjc7HhEDn25SYNjZA73iDAST4EnMOE1x/LrwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;