<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientNotifikasiController extends Controller
{
    public function update(Request $request, $id) {
        auth()->user()->unreadNotifications->where('id', $id)->first()?->markAsRead();
        return back();
    }
}
