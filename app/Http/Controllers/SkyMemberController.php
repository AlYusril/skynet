<?php

namespace App\Http\Controllers;

use App\Models;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkyMemberController extends Controller
{
    public function index()
    {
        $data['models']= Auth::user()->member;
        return view('client.member_index', $data);
    }

    public function show($id) {
        $data['title'] = "Detail Member";
        $data['model'] = Member::with('biaya','biaya.children')
            ->where('id', $id)
            ->where('client_id', Auth::user()->id)->firstOrFail();
        return view('client.member_show', $data);
    }
}
