<!-- resources/views/emails/alert.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; direction: rtl; background: #f9f9f9; padding: 20px; }
        .box { background: #fff3cd; padding: 20px; border-radius: 10px; border: 1px solid #ffeeba; }
    </style>
</head>
<body>
    <div class="box">
        <h3>🔔 تنبيه</h3>
        <p>{{ $messageText }}</p>
        <p>فريق Gaza Store 💙</p>
    </div>
</body>
</html>
