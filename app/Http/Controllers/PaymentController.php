<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Product;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{

    public function processPayment(Request $request)
    {


            Stripe::setApiKey(config('services.stripe.secret'));

            $YOUR_DOMAIN = 'http://localhost:8000'; // استبدل هذا بالنطاق الفعلي الخاص بك

            try {
                $checkout_session = Session::create([
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Cool Product',
                            ],
                            'unit_amount' => 2000, // المبلغ بالسنت (20 دولار)
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => $YOUR_DOMAIN . '/checkout/success',
                    'cancel_url' => $YOUR_DOMAIN . '/checkout/canceled',
                ]);

                return redirect($checkout_session->url);
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }
    }
