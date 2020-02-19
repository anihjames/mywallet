<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;

class PaymentController extends Controller
{
   
    public function redirectToGateway(Request $request)
    {
        //$amount = $request['amount'] * 100;
        //dd($amount);
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
