<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ClientMemberController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'member_id' => 'required'
        ]);
        // $client = \App\Models\User::find($request->client_id);
        $member = \App\Models\Member::find($request->member_id);
        $member->client_id = $request->client_id;
        $member->save();
        flash('Data sudah ditambahkan');
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $member = \App\Models\Member::findOrFail($id);
        $member->client_id = null;
        $member->save();
        flash('Data telah dihapus');
        return back();
    }

}
