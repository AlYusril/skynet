<?php

namespace App\Http\Controllers;

use App\Models\BankSkynet;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkyMemberTagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::clientMember()->latest();
        if (request()->filled('q')) {
            $tagihan = $tagihan->search(request('q'));
        }
        // $memberId = Auth::user()->member->pluck('id');
        $data ['tagihan'] = $tagihan->get();
        return view('client.tagihan_index', $data);
    }

    public function show($id)
    {
        // $memberId = Auth::user()->member->pluck('id');
        // $tagihan = Tagihan::whereIn('member_id', $memberId)->findOrFail($id);
        $tagihan = Tagihan::clientMember()->findOrFail($id);
        if ($tagihan->status == 'lunas') {
            $pembayaranId = $tagihan->pembayaran->last()->id;
            return redirect()->route('client.pembayaran.show', $pembayaranId);
        }
        $data['bankSkynet'] = BankSkynet::all();
        $data['tagihan'] = $tagihan;
        $data['member'] = $tagihan->member;
        return view('client.tagihan_show', $data);
    }
}
