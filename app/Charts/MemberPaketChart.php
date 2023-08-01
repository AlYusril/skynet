<?php

namespace App\Charts;

use App\Models\Biaya;
use App\Models\Member;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MemberPaketChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $memberPaket = Member::groupBy('biaya_id')->pluck('biaya_id');
        $data = [];
        $labels = [];

        foreach ($memberPaket as $biayaId) {
            $count = Member::where('biaya_id', $biayaId)->count();
            $data[] = $count;
            
            // Ambil nama biaya berdasarkan ID
            $biaya = Biaya::find($biayaId);
            $labels[] = $biaya ? $biaya->nama : 'Unknown';
        }

        return $this->chart->pieChart()
            ->setTitle('Data Member per Paket Internet')
            ->setSubtitle(date('Y'))
            ->setWidth(500)
            ->setHeight(500)
            ->addData($data)
            ->setLabels($labels);
    }
}
