<?php

$accessToken = 'YYcTPvcAIdazJuNniN4vp6JzzsnGYudow342TumrrLvoTDdBPtVchEmnBj50iMZYMuXT1TMa5NNu52FSNeESdml0N8N7ReWkqrdcIXbSnKbNASc6YG186sPqkCWyX3pP2k9l4e5Z6dDErIz0pVa+oQdB04t89/1O/w1cDnyilFU=';

//COMPOSERでインストールしたライブラリー一括読み込み
require_once __DIR__ . ’/vendor/autoload.php’;

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));

$bot = new \LINE\LINEBot($httpClient,['channelSecret' => getenv('CHANNEL_SECRET')]);

$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

$events = $bot->parseEventRequest(file_get_contents('php://input'),$signature);

foreach ($events as $event) {
  $bot->replyText($event->getReplyToken(), 'TextMessage');
}
 ?>
