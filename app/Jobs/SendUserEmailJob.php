<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {

        $user = User::find($this->userId);

        if (!$user || !$user->email) {
            Log::error("المستخدم غير موجود أو لا يملك إيميل - ID: {$this->userId}");
            return;
        }

        Mail::raw("مرحباً {$user->name}، هذه رسالة من Gaza Store",
        function ($message) use ($user) {
            $message->to($user->email)
            ->subject("تنبيه من المتجر");
        });

        Log::info("تم إرسال الإيميل إلى {$user->email}");
    }
}
