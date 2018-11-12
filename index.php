<?php
require_once(dirname(FILE)."/vender/autoload.php");

$httpClient= new \ LINE \ LINEBot \ HTTPClient \ CurlHTTPClient('YYcTPvcAIdazJuNniN4vp6JzzsnGYudow342TumrrLvoTDdBPtVchEmnBj50iMZYMuXT1TMa5NNu52FSNeESdml0N8N7ReWkqrdcIXbSnKbNASc6YG186sPqkCWyX3pP2k9l4e5Z6dDErIz0pVa+oQdB04t89/1O/w1cDnyilFU=');

$bot= new \ LINE \ LINEBot($httpClient,['channelSecret' => '8dcb7ea00ac740c15259b6e9748229dd']);

$signature = $_SERVER['HTTP_' . \ LINE \ LINEBot \ Constant \ HTTPHeader::LINE_SIGNATURE];

$events = $bot->parseEventRequest(file_get_contents('php://input'),$signature);

foreach ($events as $event) {
  $bot->replyText($event->getReplyToken(), 'TextMessage');
}

?>
