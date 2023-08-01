<?php

namespace App\Jobs;

use App\Models\Member;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Notifications\TagihanNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Imtigger\LaravelJobStatus\Trackable;

class ProcessTagihanStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    private $requestData;
    /**
     * Create a new job instance.
     */
    public function __construct($requestData)
    {
        $this->requestData = $requestData;
        $this->prepareStatus();
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $requestData = $this->requestData;
        $tanggalTagihan = Carbon::parse($requestData['tanggal_tagihan']);
        $bulanTagihan = $tanggalTagihan->format('m');
        $tahunTagihan = $tanggalTagihan->format('Y');
        $member = Member::with('biaya', 'tagihan', 'tagihan.tagihanDetails')->currentStatus('aktif');
        if (isset($requestData['member_id']) && $requestData['member_id'] != null) {
            $member = $member->where('id', $requestData['member_id']);
        }
        $member = $member->get();
        $this->setProgressMax($member->count());
        $i=1;
        foreach ($member as $itemMember) {
            $this->setProgressNow($i);
            $i++;
            $requestData['member_id'] = $itemMember->id;
            $requestData['status'] = 'baru';

            $cekTagihan = $itemMember->tagihan->filter(function ($value) use ($bulanTagihan, $tahunTagihan) {
                return $value->tanggal_tagihan->year == $tahunTagihan && 
                $value->tanggal_tagihan->month == $bulanTagihan;
            })->first();
            
            if($cekTagihan == null){
                $tagihan = Tagihan::create($requestData);
                // if ($tagihan->member->client != null) {
                //     Notification::send($tagihan->member->client, new TagihanNotification($tagihan));
                // }
                $biaya = $itemMember->biaya->children;
                foreach ($biaya as $itemBiaya) {
                    TagihanDetail::create([                            
                        'tagihan_id' => $tagihan->id,
                        'nama_biaya' => $itemBiaya->nama,
                        'jumlah_biaya' => $itemBiaya->jumlah,
                    ]);
                }
            }
            // sleep(1);
            // usleep(1000);
        }
        $this->setOutput(['message' => 'Tagihan '. ubahBulanLaravel($bulanTagihan). ' ' . $tahunTagihan]);
    }
}
