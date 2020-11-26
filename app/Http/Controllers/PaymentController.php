<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Account;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $decPrice = $request->price *100;

        // Stripe::setApiKey('sk_test_51HpeMXDt6vNlBQPrh7Gl56IQC9KR6cSLgHO9GWpMcn3Y4cyxstTSj3Z9jFqm084U0c8BbySO8oaoxOmGVcqLlD7M00Y3I6ZDCP');
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = PaymentIntent::create([
            'amount' => $decPrice,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'receipt_email' => Auth::user()->email, //Stripe will automatically send a receipt to this email if payment succeeded
        ]);

        $clientSecret = Arr::get($intent, 'client_secret');

        return response()->json($clientSecret);
    }

}
