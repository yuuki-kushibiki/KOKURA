<?php
require_once("./vendor/autoload.php");

$httpClient= new \ LINE \ LINEBot \ HTTPClient \ CurlHTTPClient('YYcTPvcAIdazJuNniN4vp6JzzsnGYudow342TumrrLvoTDdBPtVchEmnBj50iMZYMuXT1TMa5NNu52FSNeESdml0N8N7ReWkqrdcIXbSnKbNASc6YG186sPqkCWyX3pP2k9l4e5Z6dDErIz0pVa+oQdB04t89/1O/w1cDnyilFU=');

$bot= new \ LINE \ LINEBot($httpClient,['channelSecret' => '8dcb7ea00ac740c15259b6e9748229dd']);

$signature = $_SERVER['HTTP_' . \ LINE \ LINEBot \ Constant \ HTTPHeader::LINE_SIGNATURE];

$events = $bot->parseEventRequest(file_get_contents('php://input'),$signature);

foreach ($events as $event) {
//replyTextMessage($bot, $event->getReplyToken(), 'TextMessage');
replyLocationMessage($bot, $event->getReplyToken(), 'LINE' ,
'東京都渋谷区渋谷ヒカリエ',
35.659025,139.703473);
}

function replyTextMessage($bot, $replyToken, $text){
  $response = $bot->replyMessage($replyToken, new \ LINE \ LINEBot \ MessageBuilder \ TextMessageBuilder($text));

  if(!$response->isSucceeded()) {
error_log('Failed! '. $response->getHTTPStatus .' '. $response->getRAwBody());
  }
}
//function replyImageMessage($bot, $replyToken, $originalImageUrl,$previewImageUrl){
//  $response = $bot->replyMessage($replyToken, new \ LINE \ LINEBot \ MessageBuilder \ ImageMessageBuilder($originalImageUrl, $previewImageUrl));

//  if(!$response->isSucceeded()) {
//  error_log('Failed! '. $response->getHTTPStatus .' '. $response->getRAwBody());
//}

function replyLocationMessage($bot, $replyToken, $title, $address, $lat , $lon){
$response = $bot->replyMessage($replyToken, new \ LINE \ LINEBot \ MessageBuilder \ LocationMessageBuilder($title, $address, $lat, $lon));

if(!$response->isSucceeded()) {
error_log('Failed! '. $response->getHTTPStatus .' '. $response->getRAwBody());
 }
}
?>
