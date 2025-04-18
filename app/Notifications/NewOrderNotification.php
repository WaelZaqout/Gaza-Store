<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // يمكن إزالة 'mail' لو تريد فقط عبر dashboard
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'تم إنشاء طلب جديد',
            'body' => 'رقم الطلب: ' . $this->order->id,
            'order_id' => $this->order->id,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('طلب جديد')
                    ->line('تم إضافة طلب جديد برقم: ' . $this->order->id)
                    ->action('عرض الطلب', url('/admin/orders/' . $this->order->id));
    }
}
