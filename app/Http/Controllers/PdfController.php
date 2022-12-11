<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Orders;
use App\Models\LabTest;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->order = new Orders();
        $this->user = new User();
        $this->labtest = new LabTest();
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

    public function reportPrint(){
        $order_data = $this->order->getTestOrdersByBarcode(request()->get('id'));
        $test_type_data = $this->labtest->getById($order_data->test_id);
        $patient_data = $this->user->getById($order_data->patient_id);

        $pdf = PDF::loadView('report', [
            'title' => 'CodeAndDeploy.com Laravel Pdf Tutorial',
            'description' => 'This is an example Laravel pdf tutorial.',
            'footer' => 'by <a href="https://codeanddeploy.com">codeanddeploy.com</a>',
            'barcode'=> request()->get('id'),
            'order_data'=>$order_data,
            'test_type_data'=>$test_type_data,
            'patient_data'=>$patient_data
        ]);

        return $pdf->stream('report.pdf');
    }
}
