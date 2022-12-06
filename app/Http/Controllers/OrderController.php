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

    public function orderPlace(Request $request){
        try{
            $userData = request()->session()->get('user_data');
            $cartArray = Session::get('cart_item');
            $cartItemArray = [];
            $cartTotal = 0;
            $no_of_test = count($cartArray);

            $orderData = array(
                'patient_id'=>$userData['id'],
                'no_of_test'=>$no_of_test,
                'created_at'=> date('Y-m-d H:i:s')
            );

            $order_id = $this->order->saveOrder($orderData);

            session(['order_to_be_pay' => $order_id]);

            
            foreach($cartArray as $key=>$item){
                $testData = $this->labtest->getById($item);
                $cartTotal = $cartTotal + $testData->amount;
                $testOrderData = array(
                    'order_no'=>$order_id,
                    'patient_id'=>$userData['id'],
                    'test_id'=>$item,
                    'fee'=>$testData->amount,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $testOrderId = $this->order->saveTestOrder($testOrderData);
                $barcode = $this->common->generateBarcode($testOrderId);
                $barcodeData = array(
                    'barcode'=>$barcode,
                    'updated_at'=>date('Y-m-d H:i:s')
                );

                $updateOrder = $this->order->updateTestOrder($barcodeData,$testOrderId);

                
                
            }
            session(['amount_to_be_pay' => $cartTotal]);

            $updateOrderData = array(
                'order_total'=>$cartTotal,
                'updated_at'=>date('Y-m-d H:i:s')
            );

            $updateOrderTotal = $this->order->updateOrder($updateOrderData,$order_id);

            if($updateOrderTotal){
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = 'Success';
            }else{
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again!";
            }


        }catch(Throwable $e){
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }
        return $response;
    }


    public function paymentSuccess(Request $request){

        return view('payment-success');

    }
}
