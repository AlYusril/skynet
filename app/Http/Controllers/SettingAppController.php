<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingAppController extends Controller
{
    public function create() 
    {
        return view('admin.setting_aplikasi_form');
    }
}
