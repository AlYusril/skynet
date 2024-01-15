<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiBerandaClientController extends Controller
{
    public function index() {
        $members = Member::where('client_id', Auth::id())->get();
        $totalTagihanBelumBayar = $members->sum(function ($member) {
            return $member->tagihan->where('status', '<>', 'lunas')->count();
        });
        /* foreach ($members as $member) {
            $totalTagihan = $member->tagihan->where('status','<>','lunas')->count();
            $totalTagihanBelumBayar += $totalTagihan;
        } */

        $response = [
            'total_tagihan_belum_bayar' => $totalTagihanBelumBayar,
            'data_member' => $members->makeHidden(['tagihan','client_id']),
        ];
        return $this->okResponse("Data Member", $response);
    }
}
