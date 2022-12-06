<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;
use App\Models\UserSession;
use App\Models\LabTest;
use App\Models\User;

class CheckoutController extends Controller
{
    //
    public function __construct()
    {
        $this->session = new UserSession();
        $this->labtest = new LabTest();
        $this->user = new User();
    }
    public function checkoutView(Request $request)
    {
        if (session()->has('user_data') ) {
            $userData = request()->session()->get('user_data');
            $loggedUser = $this->user->getById($userData['id']);
            $cartArray = Session::get('cart_item');
            $cartItemArray = [];
            $cartTotal = 0;
            
            foreach ($cartArray as $key => $item) {
                $testData = $this->labtest->getById($item);
                $cartTotal = $cartTotal + $testData->amount;

                array_push($cartItemArray, $testData);
            }

            return view('checkout',['cartItemArray'=>$cartItemArray,'cartTotal'=>$cartTotal,'loggedUser'=>$loggedUser]);
        } else {
            return redirect('/login');
        }
    }
}
