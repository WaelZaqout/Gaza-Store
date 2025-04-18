<?php

namespace App\Jobs;

use App\Models\order;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteOldPendingOrdersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $orders = Order::with('user')
            ->where('status', 'pending')
            ->where('created_at', '<', now()->subDays(3)) // فقط الطلبات اللي عمرها 3 أيام فأكثر
            ->get();

        foreach ($orders as $order) {
            $daysPending = now()->diffInDays($order->created_at);

            // ✉️ إذا مرّ 3 أيام بالضبط → أرسل تنبيه
            if ($daysPending === 3 && $order->user && $order->user->email) {
                Mail::send('emails.alert', [
                    'messageText' => "طلبك رقم {$order->id} لم يُدفع منذ 3 أيام. سيتم حذفه بعد يومين إن لم يتم السداد."
                ], function ($message) use ($order) {
                    $message->to($order->user->email)
                        ->subject('🔔 تنبيه بشأن طلبك من Gaza Store');
                });

                Log::info("✉️ تم إرسال تنبيه للطلب رقم {$order->id}");
            }

            // 🗑️ إذا مرّ 5 أيام أو أكثر → احذف الطلب
            if ($daysPending >= 5) {
                $order->delete();
                Log::info("🗑️ تم حذف الطلب رقم {$order->id} بسبب عدم الدفع بعد 5 أيام.");
            }
        }
    }
}
