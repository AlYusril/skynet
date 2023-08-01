<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index() 
    {
        $log = Activity::latest()->paginate(Settings('app_pagination'));
        return view('admin.logactivity_index', [
            'models' => $log,
            'title' => 'Log Activity',
        ]);
    }
}
