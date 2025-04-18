<?php

namespace App\Jobs;

use App\Models\order;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendInvoiceEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }
    /**
     * Execute the job.
     */
    public function handle()
    {
        $order =order::with('user')->find($this->orderId);

        if (!$order || !$order->user || !$order->user->email) {
            return;
        }

        $pdf = Pdf::loadView('invoice', ['order' => $order]);

        Mail::send([], [], function ($message) use ($order, $pdf) {
            $message->to($order->user->email)
                ->subject('فاتورتك من Gaza-Store')
                ->attachData($pdf->output(), "invoice_{$order->id}.pdf");
        });
    }
}

