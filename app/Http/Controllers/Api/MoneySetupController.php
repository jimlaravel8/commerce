<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use URL;
use Redirect;
use Input;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MoneySetupController extends Controller
{
    public function paymentStripe()
    {
        return view('stripe.PaymentStripe');
    }
    public function postPaymentStripe(Request $request)
    {
        // return $request->all();
        $request->validate([
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            //'amount' => 'required',
        ]);
        $input = $request->all();

            $input = Arr::except($input, array('_token'));
            // $input = array_except($input, array('_token'));
            $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    return redirect()->route('addmoney.paymentstripe');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => 2.49,
                    'description' => 'wallet',
                ]);

                if ($charge['status'] == 'succeeded') {
                    echo "<pre>";
                    print_r($charge);
                    exit();
                    return redirect()->route('addmoney.paymentstripe');
                } else {
                   Session::put('error', 'Money not add in wallet!!');
                    return redirect()->route('addmoney.paymentstripe');
                }
            } catch (Exception $e) {
               Session::put('error', $e->getMessage());
                return redirect()->route('addmoney.paymentstripe');
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
               Session::put('error', $e->getMessage());
                return redirect()->route('addmoney.paywithstripe');
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
               Session::put('error', $e->getMessage());
                return redirect()->route('PaymentStripe');
            }

    }
}
