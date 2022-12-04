<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;
use App\Models\UserSession;
use App\Models\LabTest;

class CartController extends Controller
{
    public function __construct()
    {
        $this->session = new UserSession();
        $this->labtest = new LabTest();
    }

    public function addItem(Request $request){
        try{
            $product_id = $request->post('id');

            $addToSess = $this->session->addItemToCart($product_id);
            
            if(count($addToSess) > 0){
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = 'Successfuly added to cart!';
                $response[0]['cartCount'] = count($addToSess);
            }else{
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }
            
            

        }catch(Throwable $e){
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function cartView(){
        $cartArray = Session::get('cart_item');
        $cartItemArray = [];
        $cartTotal = 0;
        foreach($cartArray as $key=>$item){
            $testData = $this->labtest->getById($item);
            $cartTotal = $cartTotal + $testData->amount;

            array_push($cartItemArray,$testData);

        }
        
        return view('cart',['cartItemArray'=>$cartItemArray,'cartTotal'=>$cartTotal] );
    }

    
}
