<?php

namespace GoodWe;

class GoodWeConnector
{
    const BROADCAST_MESSAGE = 'aa55c07f0102000241';
    const USAGE_MESSAGE = '7f0375940049d5c2';
    const INFO_MESSAGE = '7f03753100280409';
    const PORT = 8899;

    protected $socket;


    public function __construct()
    {
        if (!($this->socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP))) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            die("Couldn't create socket: [$errorcode] $errormsg \n");
        }
    }

    public function sendMessage($message, $ip, $port = self::PORT)
    {
        $message = hex2bin($message);
        if (!socket_sendto($this->socket, $message, strlen($message), 0, $ip, $port)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            die("Could not send data: [$errorcode] $errormsg \n");
        }

        if (socket_recv($this->socket,$reply, 2048, MSG_WAITALL) === FALSE) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            die("Could not receive data: [$errorcode] $errormsg \n");
        }

        return $reply;
    }

    public function sendUsageMessage($ip)
    {
        return $this->sendMessage(self::USAGE_MESSAGE, $ip);
    }

    public function getSerial($ip)
    {
        return $this->sendMessage(self::INFO_MESSAGE, $ip);
    }
}