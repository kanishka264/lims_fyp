<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Orders;
use App\Models\LabTest;

class BraintreeController extends Controller
{
    public function __construct()
    {
        $this->order = new Orders();
        $this->labtest = new LabTest();
    }

    public function token(Request $request){
        // dd(request()->session()->get('amount_to_be_pay'));
        
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        if($request->input('nonce') != null){
            $nonceFromTheClient = $request->input('nonce');

            $amountSes = request()->session()->get('amount_to_be_pay');
            $amount = sprintf('%0.2f', $amountSes);
    
            $response = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            // dd($response);
            if($response->success == true){
                $userData = request()->session()->get('user_data');
                $paymentData = array(
                    'payment_id'=>$response->transaction->id,
                    'paid_amount'=>$response->transaction->amount,
                    'response_text'=>$response->transaction->processorResponseText,
                    'response_code'=>$response->transaction->processorResponseCode,
                    'order_no'=> request()->session()->get('order_to_be_pay'),
                    'patient_id'=>$userData['id'],
                    'created_at'=> date('Y-m-d H:i:s')
                );

                $now = date("Y-m-d H:i:s");
                $appointmentDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($now))); 

                $storePayement = $this->order->savePayment($paymentData);
                $updateTestOrderData = array(
                    'payment_referance' =>$response->transaction->id,
                    'payment_status'=>$response->transaction->processorResponseCode,
                    'appointment_time'=>$appointmentDate,
                    'updated_at'=>date('Y-m-d H:i:s')
                );
                $order_id = request()->session()->get('order_to_be_pay');
                $updatePay = $this->order->updateOrders($updateTestOrderData,$order_id);
                $cartTotal = request()->session()->get('amount_to_be_pay');
                Session::forget('order_to_be_pay');
                Session::forget('amount_to_be_pay');
                Session::forget('cart_item');

                $responseSet[0]['payment_id'] = $response->transaction->id;
                $responseSet[0]['order_id'] =$order_id;
                $responseSet[0]['cartTotal'] =$cartTotal;
                $responseSet[0]['res'] =200;
                return $responseSet;
            }else{
               
                $responseSet[0]['res'] =400;
                return $responseSet;
            }
            
        }else{
            // dd('not set');
            $clientToken = $gateway->clientToken()->generate();
            return view ('braintree',['token' => $clientToken]);
        }
        
    }
}
