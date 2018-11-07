<?php
$accessToken = 'YYcTPvcAIdazJuNniN4vp6JzzsnGYudow342TumrrLvoTDdBPtVchEmnBj50iMZYMuXT1TMa5NNu52FSNeESdml0N8N7ReWkqrdcIXbSnKbNASc6YG186sPqkCWyX3pP2k9l4e5Z6dDErIz0pVa+oQdB04t89/1O/w1cDnyilFU=';
$jsonString = file_get_contents('php://input'); error_log($jsonString);
$jsonObj = json_decode($jsonString); $message = $jsonObj->{"events"}[0]->{"message"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};


 // 送られてきたメッセージの中身からレスポンスのタイプを選択
if ($message->{"text"} == '出勤確認') {
     // 確認ダイアログタイプ
    $messageData = [
        'type' => 'template',
        'altText' => '確認ダイアログ',
        'template' => [ 'type' => 'confirm', 'text' => '出勤してますか？',
            'actions' => [
                [ 'type' => 'message', 'label' => '出勤してます。', 'text' => '出勤してます' ],
                [ 'type' => 'message', 'label' => '欠席します', 'text' => '欠席します' ],
            ]
        ]
 ];
} elseif ($message->{"text"} == 'ボタン') {
    // ボタンタイプ
    $messageData = [
        'type' => 'template',
         'altText' => 'ボタン',
        'template' => [
             'type' => 'buttons',
             'title' => 'タイトルです',
             'text' => '選択してね',
            'actions' => [
                 [
                    'type' => 'postback',
                    'label' => 'webhookにpost送信',
                    'data' => 'value'
                ],
                 [
                     'type' => 'uri',
                     'label' => 'googleへ移動',
                     'uri' => 'https://google.com'
                 ]
              ]
          ]
     ];
} elseif ($message->{"text"} == 'カルーセル') {
     // カルーセルタイプ
    $messageData = [
        'type' => 'template',
        'altText' => 'カルーセル',
        'template' => [
             'type' => 'carousel',
            'columns' => [
                [
                    'title' => 'カルーセル1',
                    'text' => 'カルーセル1です',
                     'actions' => [
                         [
                            'type' => 'postback',
                             'label' => 'webhookにpost送信',
                             'data' => 'value'
                         ],
                         [
                            'type' => 'uri',
                            'label' => '美容の口コミ広場を見る',
                             'uri' => 'http://clinic.e-kuchikomi.info/'
                         ]
                    ]
                ],
                 [
                        'title' => 'カルーセル2',
                        'text' => 'カルーセル2です',
                        'actions' => [
                            [
                                'type' => 'postback',
                                'label' => 'webhookにpost送信',
                                'data' => 'value'
                            ],
                            [
                                'type' => 'uri',
                                'label' => 'ONEPIECEのHP',
                                'uri' => 'https://jobikai.com/'
                            ]
                        ]
                    ],
                    [
                           'title' => 'カルーセル３',
                           'text' => 'カルーセル３です',
                           'actions' => [
                               [
                                   'type' => 'postback',
                                   'label' => 'webhookにpost送信',
                                   'data' => 'value'
                               ],
                               [
                                   'type' => 'uri',
                                   'label' => 'ONEPIECE',
                                   'uri' => 'https://1onepiece.jp/'
                               ]
                           ]
                       ],
                ]
            ]
    ];
 }
 else {
     // それ以外は送られてきたテキストをオウム返し
     $messageData = [ 'type' => 'text', 'text' => $message->{"text"} ];
}

$response = [ 'replyToken' => $replyToken, 'messages' => [$messageData] ];
error_log(json_encode($response));
$ch = curl_init('https://api.line.me/v2/bot/message/reply');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . $accessToken ));
$result = curl_exec($ch); error_log($result);
curl_close($ch);
