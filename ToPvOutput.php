<?php

namespace GoodWe;

class ToPvOutput
{
    const PVOUTPUT_URL = 'https://pvoutput.org/service/r2/addstatus.jsp';

    public static function send(array $inverter, GoodWeOutput $goodWeOutput)
    {
        if (!array_key_exists('pvoutput', $inverter)) {
            throw new \Exception('No pvoutput details given');
        }

        $ch = curl_init();

        $headers = [
            'X-Pvoutput-Apikey: ' . $inverter['pvoutput']['apiKey'],
            'X-Pvoutput-SystemId: ' . $inverter['pvoutput']['systemId'],
        ];

        curl_setopt($ch, CURLOPT_URL,self::PVOUTPUT_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            http_build_query(
                [
                    'd' => $goodWeOutput->getDateTime()->format('Ymd'),
                    't' => $goodWeOutput->getDateTime()->format('H:i'),
                    'v1' => $goodWeOutput->getGenerationToday() * 1000,
                    'v2' => $goodWeOutput->getPower() * 1000,
                    'v5' => $goodWeOutput->getTemperature(),
                    'v6' => $goodWeOutput->getVoltageAc1(),
                ]
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $serverOutput = curl_exec($ch);

        curl_close ($ch);
        echo 'PVOutput result: ' . $serverOutput . PHP_EOL;
    }
}