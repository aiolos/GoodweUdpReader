<?php

use GoodWe\GoodWeInfo;
use GoodWe\GoodWeProcessor;
use GoodWe\GoodWeConnector;
use GoodWe\ToPvOutput;

require_once "GoodWeInfo.php";
require_once "GoodWeConnector.php";
require_once "GoodWeProcessor.php";
require_once "GoodWeOutput.php";
require_once "GoodWeValidator.php";
require_once "ToPvOutput.php";
require_once "inverters.php";

$connector = new GoodWeConnector();

foreach ($inverters as $inverter) {
    echo "===========================" . PHP_EOL;
    echo "Trying " . $inverter['name'] . ' (' . $inverter['ip'] . ')' . PHP_EOL;

    $serialReply = $connector->getSerial($inverter['ip']);
    $goodWeInfo = new GoodWeInfo($serialReply);
    $goodWeInfo->show();

    $reply = $connector->sendUsageMessage($inverter['ip']);
    $goodweOutput = GoodWeProcessor::process($reply);

    $goodweOutput->show();
    if (array_key_exists('pvoutput', $inverter)) {
        ToPvOutput::send($inverter, $goodweOutput);
    }
}
