<?php

namespace App\Http\Controllers;

use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;
use App\Models\UserSession;
use App\Models\LabTest;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->session = new UserSession();
        $this->labtest = new LabTest();
        $this->user = new User();
        $this->order = new Orders();
        $this->common = new Common();
    }

    public function orderPlace(Request $request)
    {
        try {
            $userData = request()->session()->get('user_data');
            $cartArray = Session::get('cart_item');
            $cartItemArray = [];
            $cartTotal = 0;
            $no_of_test = count($cartArray);

            $orderData = array(
                'patient_id' => $userData['id'],
                'no_of_test' => $no_of_test,
                'created_at' => date('Y-m-d H:i:s')
            );

            $order_id = $this->order->saveOrder($orderData);

            session(['order_to_be_pay' => $order_id]);


            foreach ($cartArray as $key => $item) {
                $testData = $this->labtest->getById($item);
                $cartTotal = $cartTotal + $testData->amount;
                $testOrderData = array(
                    'order_no' => $order_id,
                    'patient_id' => $userData['id'],
                    'test_id' => $item,
                    'fee' => $testData->amount,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $testOrderId = $this->order->saveTestOrder($testOrderData);
                $barcode = $this->common->generateBarcode($testOrderId);
                $barcodeData = array(
                    'barcode' => $barcode,
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $updateOrder = $this->order->updateTestOrder($barcodeData, $testOrderId);
            }
            session(['amount_to_be_pay' => $cartTotal]);

            $updateOrderData = array(
                'order_total' => $cartTotal,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $updateOrderTotal = $this->order->updateOrder($updateOrderData, $order_id);

            if ($updateOrderTotal) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = 'Success';
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again!";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }
        return $response;
    }


    public function paymentSuccess(Request $request)
    {

        return view('payment-success');
    }

    public function verificationPending()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {

            $status = 0;

            $field = 'verified_status';

            $reportList = $this->order->getByFieldValue($field, $status);

            foreach ($reportList as $key => $value) {
                $patientData = $this->user->getById($value->patient_id);
                $reportList[$key]->patient_name = $patientData->first_name . ' ' . $patientData->last_name;

                $reportList[$key]->age = $this->common->age($patientData->date_of_birth);
            }
            // dd($reportList);
            return view('admin-portal/reservations/verify-pending', ['reportList' => $reportList]);
        } else {

            return redirect('/ portal-login');
        }
    }

    // public function reportPageView()
    // {
    //     if (Auth::check() && session()->get('user_role_type') == 'admin') {

    //         $reportList = $this->order->getTestOrdersById(request()->get('id'));

    //         $patientData = $this->user->getById($reportList->patient_id);
    //         $reportList->patientData = $patientData;

    //         $reportList->age = $this->common->age($patientData->date_of_birth);

    //         return view('admin-portal/report/'.$reportList->report_template, ['reportList' => $reportList]);
    //     } else {

    //         return redirect('/ portal-login');
    //     }
    // }

    public function verifyReport(Request $request){
        try{
            $feild = $request->post('field');
            $updateData = array(
                $feild => 1,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = $this->order->updateOrdersById($updateData,$request->post('id'));

            if ($update) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = 'Success';
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again!";
            }
            

        }catch(Throwable $e){
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function verificationApproved()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {

            $status = 1;

            $field = 'verified_status';

            $reportList = $this->order->getByFieldValue($field, $status);

            foreach ($reportList as $key => $value) {
                $patientData = $this->user->getById($value->patient_id);
                $reportList[$key]->patient_name = $patientData->first_name . ' ' . $patientData->last_name;

                $reportList[$key]->age = $this->common->age($patientData->date_of_birth);
            }
            // dd($reportList);
            return view('admin-portal/reservations/verified', ['reportList' => $reportList]);
        } else {

            return redirect('/ portal-login');
        }
    }

    public function recivingPending()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {

            $status = 0;

            $field = 'recived_status';

            $reportList = $this->order->getByFieldValue($field, $status);

            foreach ($reportList as $key => $value) {
                $patientData = $this->user->getById($value->patient_id);
                $reportList[$key]->patient_name = $patientData->first_name . ' ' . $patientData->last_name;

                $reportList[$key]->age = $this->common->age($patientData->date_of_birth);
            }
            // dd($reportList);
            return view('admin-portal/reservations/reciving-pending', ['reportList' => $reportList]);
        } else {

            return redirect('/ portal-login');
        }
    }

    public function recivedList()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {

            $status = 1;

            $field = 'recived_status';

            $reportList = $this->order->getByFieldValue($field, $status);

            foreach ($reportList as $key => $value) {
                $patientData = $this->user->getById($value->patient_id);
                $reportList[$key]->patient_name = $patientData->first_name . ' ' . $patientData->last_name;

                $reportList[$key]->age = $this->common->age($patientData->date_of_birth);
            }
            // dd($reportList);
            return view('admin-portal/reservations/recived', ['reportList' => $reportList]);
        } else {

            return redirect('/ portal-login');
        }
    }

    public function changeAppintment(Request $request){
        try{
            $updateData = array(
                'appointment_time' => $request->post('date'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = $this->order->updateOrdersById($updateData,$request->post('id'));

            if ($update) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = 'Success';
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again!";
            }
        }catch(Throwable $e){
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }
        return $response;
    }

    public function openReportData(){
        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            $test_data = $this->order->getTestOrdersById(request()->get('id'));
            $test_type = $this->labtest->getById($test_data->test_id);

            return view('admin-portal/report/report',['test_data'=>$test_data,'test_type'=>$test_type]);
        } else {

            return redirect('/ portal-login');
        }
    }

    public function resultsSave(Request $request){
        try{
            $test_type = $this->labtest->getById($request->post('test_id'));
            $field_set = explode(',', $test_type->test_field);

            $data = array();
            foreach ($field_set as $key => $value){

                $data[$value] = $request->post($value);
                

            }

            $updateData = array(
                'results' => $data,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = $this->order->updateOrdersById($updateData,$request->post('id'));

            if ($update) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = 'Success';
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again!";
            }
           

        }catch(Throwable $e){
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }
        return $response;
    }

    public function makeAppoinmnet(){
        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            $patient_list = $this->user->getByUserCategory('patient');
            $test_list = $this->labtest->getTestingList();
            return view('admin-portal/reservations/create',['patient_list'=>$patient_list,'test_list'=>$test_list]);
        } else {

            return redirect('/ portal-login');
        }
    }

    public function getTestPricee(Request $request){
        $test_id = $request->post('test_id');
        $testData = $this->labtest->getById($test_id);
        $response[0]['amount'] = $testData->amount;
        return $response;
    }

    public function saveManualAppointment(Request $request){

        $now = date("Y-m-d H:i:s");
        $appointmentDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($now))); 

        $orderData = array(
            'patient_id' => $request->post('patient_id'),
            'no_of_test' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        $order_id = $this->order->saveOrder($orderData);

        $testOrderData = array(
            'order_no' => $order_id,
            'patient_id' => $request->post('patient_id'),
            'test_id' => $request->post('test_id'),
            'fee' => $request->post('paid_amount'),
            'payment_status'=>'1000',
            'payment_referance'=>'Manual Payment',
            'appointment_time'=>$appointmentDate,
            'created_at' => date('Y-m-d H:i:s')
        );

        $testOrderId = $this->order->saveTestOrder($testOrderData);
        $barcode = $this->common->generateBarcode($testOrderId);
        $barcodeData = array(
            'barcode' => $barcode,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $updateOrder = $this->order->updateTestOrder($barcodeData, $testOrderId);

        $paymentData = array(
            'payment_id'=>'manual',
            'paid_amount'=>$request->post('paid_amount'),
            'response_text'=>'Approved',
            'response_code'=>'1000',
            'order_no'=> $order_id,
            'patient_id'=>$request->post('patient_id'),
            'created_at'=> date('Y-m-d H:i:s')
        );

        $storePayement = $this->order->savePayment($paymentData);

        if ($updateOrder) {
            $response[0]['response_code'] = 200;
            $response[0]['response_text'] = 'Success';
        } else {
            $response[0]['response_code'] = 400;
            $response[0]['response_text'] = "Something went wrong. Please try again!";
        }

        return $response;

    }

    
}
