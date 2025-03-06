<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\order;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Stripe يتطلب التحقق من التوقيع الأمني
        $endpointSecret = config('services.stripe.webhook_secret');

        $sigHeader = $request->header('Stripe-Signature');
        $payload = $request->getContent();

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Stripe Webhook Error: Invalid payload');
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Stripe Webhook Error: Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // التحقق من نوع الحدث
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            // التأكد من أن order_id موجود
            if (isset($session->metadata->order_id)) {
                $order_id = $session->metadata->order_id;
                $order = order::find($order_id);

                if ($order) {
                    $order->status = 'paid'; // تحديث حالة الطلب
                    $order->status = 'completed'; // يمكن استخدام status إذا كان لديك هذا العمود
                    $order->save();

                    Log::info("order #$order_id has been marked as PAID.");
                } else {
                    Log::warning("order #$order_id not found.");
                }
            } else {
                Log::warning("order ID not found in metadata.");
            }
        }

        return response()->json(['status' => 'success']);
    }


 

}
