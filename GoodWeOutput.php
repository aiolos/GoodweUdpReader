<?php

namespace GoodWe;

final class GoodWeOutput
{
    const WORK_MODE_WAIT = 0;
    const WORK_MODE_NORMAL = 1;
    const WORK_MODE_ERROR = 2;
    const WORK_MODE_CHECK = 4;

    protected $currentDc1;
    protected $voltDc1;
    protected $voltAc1;
    protected $currentAc1;
    protected $frequencyAc1;
    protected $rssi;
    protected $totalHours;
    protected $generationTotal;
    protected $generationToday;
    protected $temperature;
    protected $workMode;
    protected $power;
    /**
     * @var \DateTime
     */
    private $dateTime;

    public function __construct()
    {
    }

    public function setDateTime($dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    public function toArray(): array
    {
        return [
            'dateTime' => $this->dateTime->format(DATE_ATOM),
            'voltDc1' => $this->voltDc1,
            'currentDc1' => $this->currentDc1,
            'voltAc1' => $this->voltAc1,
            'currentAc1' => $this->currentAc1,
            'frequencyAc1' => $this->frequencyAc1,
            'power' => $this->power,
            'workMode' => $this->workMode,
            'readableWorkMode' => $this->getReadableWorkMode(),
            'temperature' => $this->temperature,
            'generationToday' => $this->generationToday,
            'generationTotal' => $this->generationTotal,
            'totalHours' => $this->totalHours,
            'rssi' => $this->rssi,
        ];
    }

    public function setVoltDc1($volt)
    {
        $this->voltDc1 = $volt;
    }

    public function setCurrentDc1($current)
    {
        $this->currentDc1 = $current;
    }

    public function setVoltAc1($voltage)
    {
        $this->voltAc1 = $voltage;
    }

    public function getVoltageAc1()
    {
        return $this->voltAc1;
    }

    public function setCurrentAc1($current)
    {
        $this->currentAc1 = $current;
    }

    public function setFrequencyAc1($frequency)
    {
        $this->frequencyAc1 = $frequency;
    }

    public function setPower($power)
    {
        $this->power = $power;
    }

    public function getPower()
    {
        return $this->power;
    }

    public function setWorkMode($workMode)
    {
        $this->workMode = $workMode;
    }

    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function setGenerationToday($today)
    {
        $this->generationToday = $today;
    }

    public function getGenerationToday()
    {
        return $this->generationToday;
    }

    public function setGenerationTotal($total)
    {
        $this->generationTotal = $total;
    }

    public function setTotalHours($hours)
    {
        $this->totalHours = $hours;
    }

    public function setRSSI($rssi)
    {
        $this->rssi = $rssi;
    }

    private function getReadableWorkMode()
    {
        $workModes = [
            self::WORK_MODE_WAIT => 'Wait',
            self::WORK_MODE_NORMAL => 'Normal',
            self::WORK_MODE_ERROR => 'Error',
            self::WORK_MODE_CHECK => 'Check',
        ];

        return $workModes[$this->workMode];
    }

    public function show()
    {
        echo 'GoodWe output from ' . $this->dateTime->format(DATE_ISO8601) . PHP_EOL;

        echo 'DC1 Voltage   ' . $this->voltDc1 . 'V' . PHP_EOL;
        echo 'DC1 Current   ' . $this->currentDc1 . 'A' . PHP_EOL;
        echo 'AC1 Voltage   ' . $this->voltAc1 . 'V' . PHP_EOL;
        echo 'AC1 Current   ' . $this->currentAc1 . 'A' . PHP_EOL;
        echo 'AC1 Frequency ' . $this->frequencyAc1 . 'Hz' . PHP_EOL;
        echo 'Power         ' . $this->power . 'kW'. PHP_EOL;
        echo 'WorkMode      ' . $this->workMode . PHP_EOL;
        echo 'WorkMode      ' . $this->getReadableWorkMode() . PHP_EOL;
        echo 'temperature   ' . $this->temperature . '°C' . PHP_EOL;
        echo 'Energy Today  ' . $this->generationToday . 'kWh' . PHP_EOL;
        echo 'Energy Total  ' . $this->generationTotal . 'kWh' . PHP_EOL;
        echo 'Total hours   ' . $this->totalHours . 'h' . PHP_EOL;
        echo 'WiFi RSSI:    ' . $this->rssi . '%' . PHP_EOL;
    }
}