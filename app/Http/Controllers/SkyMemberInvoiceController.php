<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkyMemberInvoiceController extends Controller
{
    public function show($id) {
        if (Auth::user()->akses == 'client') {
            $tagihan = Tagihan::clientMember()->findOrFail($id); //khusus untuk user client
        } else {
            $tagihan = Tagihan::findOrFail($id); //bebas untuk semua user
        }
        
        $title = 'Invoice Tagihan ' . $tagihan->tanggal_tagihan->translatedFormat('F Y') . ' |';
        if (request('output') == 'pdf') {
            $pdf = Pdf::loadView('invoice_pdf', compact('tagihan', 'title'));
            $namaFile = 'invoice_' . $tagihan->member->idpel . '_' . $tagihan->tanggal_tagihan->translatedFormat('F_Y');
            return $pdf->stream($namaFile.'.pdf');
        }
        return view('invoice', compact('tagihan', 'title'));
    }
}
