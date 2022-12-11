<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function __construct()
    {
        
    }

    public function barcodePrint(){
        $pdf = PDF::loadView('barcode', [
            'title' => 'CodeAndDeploy.com Laravel Pdf Tutorial',
            'description' => 'This is an example Laravel pdf tutorial.',
            'footer' => 'by <a href="https://codeanddeploy.com">codeanddeploy.com</a>',
            'barcode'=> request()->get('id')
        ]);

        return $pdf->stream('barcode.pdf');
    }
}
