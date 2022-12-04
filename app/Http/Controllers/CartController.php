<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;
use App\Models\UserSession;

class CartController extends Controller
{
    public function __construct()
    {
        $this->session = new UserSession();
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

    
}
