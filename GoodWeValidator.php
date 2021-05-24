<?php

namespace GoodWe;

class GoodWeValidator
{
    public static function validate($binary)
    {
        $hex = bin2hex($binary);

        $crc = bin2hex(substr($binary, -1)) . bin2hex(substr($binary, -2, 1));
        $payload = substr($binary, 2, strlen($binary) - 4);
        $calculatedCrc = self::calculateCrc($payload);
        if ($crc !== $calculatedCrc) {
            throw new \Exception('Invalid CRC, got ' . $crc . ', but calculated ' . $calculatedCrc);
        }

        if (bin2hex($binary[0] . $binary[1]) !== 'aa55') {
            throw new \Exception("Invalid header in inverter response. Expected aa55, got " . substr($hex, 0, 4));
        }
    }

    private static function calculateCrc($payload)
    {
        $crc = 0xFFFF;
        $odd = null;

        for ($i = 0; $i < strlen($payload); $i++)
        {
            $crc = $crc ^ hexdec(bin2hex($payload[$i]));

            for ($j = 0; $j < 8; $j++)
            {
                $odd = ($crc & 0x0001) != 0;
                $crc >>= 1;
                if ($odd)
                {
                    $crc ^= 0xA001;
                }
            }
        }
        return str_pad(dechex($crc), 4, '0', STR_PAD_LEFT);
    }
}