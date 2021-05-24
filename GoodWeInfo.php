<?php

namespace GoodWe;

class GoodWeInfo
{
    protected $serialNumber;
    protected $inverterType;
    protected $dsp1version;
    protected $dsp2version;
    protected $armVersion;

    public function __construct($serialReply)
    {
        GoodWeValidator::validate($serialReply);

        $this->serialReply = $serialReply;

        $this->serialNumber = substr($serialReply, 11, 16);
        $this->inverterType = substr($serialReply, 27, 9);

        $message = bin2hex($serialReply);
        $this->dsp1version = hexdec(substr($message, 142, 4));
        $this->dsp2version = hexdec(substr($message, 146, 4));
        $this->armVersion = hexdec(substr($message, 150, 4));
    }

    public function show()
    {
        echo 'Inverter information: ' . PHP_EOL;
        echo 'Serial Number: ' . $this->serialNumber . PHP_EOL;
        echo 'Inverter Type: ' . $this->inverterType . PHP_EOL;

        echo 'Version: DSP1: ' . $this->dsp1version . PHP_EOL;
        echo 'Version: DSP2: ' . $this->dsp2version . PHP_EOL;
        echo 'Version: ARM:  ' . $this->armVersion . PHP_EOL;
    }
}