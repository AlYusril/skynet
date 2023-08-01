<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

class StatusController extends Controller
{
    private $flasher;

    public function __construct(FlasherInterface $flasher)
    {
        $this->flasher = $flasher;
    }

    public function update(Request $request)
    {
        if ($request->model == 'member') {
            $model = Member::findOrFail($request->id);
            $model->setStatus($request->status);
            $model->save();
            $this->flasher->addFlash('success', 'Status berhasil diubah');
            return back();
        }
    }
}
