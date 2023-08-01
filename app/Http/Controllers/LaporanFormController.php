<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanFormController extends Controller
{
    public function create() {
        $data = [
            'listBiaya' => Biaya::has('children')->whereNull('parent_id')->pluck('nama', 'id'),
        ];
        return view('admin.laporanform_index', $data);
    }
}
