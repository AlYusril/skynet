<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Imtigger\LaravelJobStatus\JobStatus;

class JobStatusController extends Controller
{
    public function index() {
        $jobStatus = JobStatus::latest()->paginate(Settings('app_pagination'));
        return view('admin.jobstatus_index', [
            'jobStatus' => $jobStatus,
            'title' => 'Job Status',
            'routePrefix' => 'jobstatus',

        ]);
    }

    public function show($id) 
    {
        $job = JobStatus::findOrFail($id);
        $data = [
            'id' => $job->id,
            'progress_now' => $job->progress_now,
            'progress_max' => $job->progress_max,
            'is_ended' => $job->is_ended,
            'progress_percentage' => $job->progress_percentage,
        ];
        return response()->json($data, 200);
    }
}
