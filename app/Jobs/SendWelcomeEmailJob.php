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

class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
protected $userId;
    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId=$userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::find($this->userId);

        if (!$user || !$user->email) {
            Log::error("المستخدم غير موجود أو لا يملك إيميل - ID: {$this->userId}");
            return;
        }
        Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('🎉 أهلًا بك في Gaza Store');
        });


        Log::info("تم إرسال الإيميل إلى {$user->email}");
        }
}
