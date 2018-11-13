<?php
require_once("./vendor/autoload.php");

$httpClient= new \ LINE \ LINEBot \ HTTPClient \ CurlHTTPClient('4HloHdjQY7BBCGIzdqUGQW/x6bjbfDq2ceHm+JN3HWpRnum1z3QYYaXrju7qKLin1NwJ4mcLAE2JLvC5v9D5idsj576xaqLc46Tg7yjUo2C50iN6rKmUExaK22zc7HqTXfg9RG5MQ7vhCA2esNLn7AdB04t89/1O/w1cDnyilFU=');

$bot= new \ LINE \ LINEBot($httpClient,['channelSecret' => '331be4568cb5f875bb56f7d5ffb0d17b']);

$signature = $_SERVER['HTTP_' . \ LINE \ LINEBot \ Constant \ HTTPHeader::LINE_SIGNATURE];

$events = $bot->parseEventRequest(file_get_contents('php://input'),$signature);

foreach ($events as $event) {
//複数まとめて動作
replyMultiMessage($bot, $event->getReplyToken(),new \ LINE \ LINEBot \ MessageBuilder \ TextMessageBuilder('TextMessage'),
new \ LINE \ LINEBot \ MessageBuilder \ ImageMessageBuilder('https://' . $_SERVER['HTTP_HOST'] .'/imgs/original.jpg', 'https://' .
$_SERVER['HTTP_HOST'] . '/imgs/preview.jpg'),new \ LINE \ LINEBot \ MessageBuilder \ LocationMessageBuilder('kushibiki',
'東京都渋谷区渋谷kushibiki',35.659025,139.703473),new \ LINE \ LINEBot \ MessageBuilder \ StickerMessageBuilder(1, 1));
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
//複数まとめて動作
function replyMultiMessage($bot, $replyToken, ...$imgs){
$builder = new \ LINE \ LINEBot \ MessageBuilder \ MultiMessageBuilder();

foreach ($msgs as $value) {
  $builder->add($value);
}
$response = $bot->replyMessage($replyToken, $builder);
if(!$response->isSucceeded()){
error_log('Failed! '. $response->getHTTPStatus .' '. $response->getRAwBody());
}
}

//buttonsテンプレート
//function replyButtonsTemplate($bot, $replyToken, $alternativeText, $imageUrl, $title, $text, ...$actions){
//$actionArray = array();

//foreach ($actions as $value) {
//  array_push($actionArray, $value);
//}
  //$builder = new \ LINE \ LINEBot \ MessageBuilder \ TemplateMessageBuilder($alternativeText,
//new \ LINE \ LINEBot \ MessageBuilder \ TemplateMessageBuilder\ ButtonTemplateBuilder($title, $text, $imageUrl, $actionArray));

//$response = $bot->replyMessage($replyToken, $builder);
//if(!$response->isSucceeded()){
//error_log('Failed! '. $response->getHTTPStatus .' '. $response->getRAwBody());
//}

//}



?>
