<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\DonutChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PembayaranStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(array $label, array $data): DonutChart
    {
        return $this->chart->donutChart()
        ->setTitle('Grafik Status Pembayaran')
        ->setSubtitle(date('F Y'))
        ->setDataLabels(true)
        ->addData($data)
        ->setFontColor('white')
        ->setLabels($label);
    }
}
