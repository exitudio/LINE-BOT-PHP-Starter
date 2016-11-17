<?php
/**
 * Created by PhpStorm.
 * User: exit
 * Date: 11/17/16
 * Time: 2:59 AM
 */
header('Content-Type: application/json; charset=utf-8');
$botData = json_decode('{"answers":[
    {
        "questions":["a","b"],
        "answer":"ansAB"
    },
    {
        "questions":["c","d"],
        "answer":"ansCD"
    }
]}
', true);


$access_token = 'Oim7BDPK584CzkBpu/6GWENT+fUjPFjastMyVTXZtyUMDP5MlOiCnl3IbZSgV8olsZA/F5gVRObhiSlWVb/UzN4/xHFhIH3Et+a8AThijuVnLFFSrwuDY7uiCRgoFweQgMGj6+R97+wnfgksqZkELgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent
            $text = $event['message']['text'];
            // Get replyToken
            $replyToken = $event['replyToken'];

            // Build message to reply back
            $messages = [
                'type' => 'text',
                'text' => botEcho($text,$botData)
            ];

            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);

            echo $result . "\r\n";
        }
    }
}


//echo botEcho("a",$botData);
function botEcho($text,$botData){
    //var_dump($botData);
    if( $botData["answers"] ){
        foreach($botData["answers"] as $answer){
            //var_dump($answer);
            if( $answer["questions"] ){
                $isFound = false;
                foreach( $answer["questions"] as $question){
                    //var_dump($question);
                    if (strpos($text, $question) !== false) {
                        $isFound = true;
                        break;
                    }
                }
                if($isFound){
                    return $answer["answer"];
                }
            }
        }
    }
}

/*$botData = json_decode('{"answers":[
    {
        "questions":["a","b"],
        "answer":"ansAB"
    },
    {
        "questions":["c","d"],
        "answer":"ansCD"
    }
]}', true);
echo botEcho("d",$botData);*/
echo "OK";