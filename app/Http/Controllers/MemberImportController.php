<?php

namespace App\Http\Controllers;

use App\Imports\MemberImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MemberImportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'template' => 'required|mimes:xlsx,xls'
        ]);
        Excel::import(new MemberImport, $request->file('template')->store('temp'));
        return back();
    }
}
