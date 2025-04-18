<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Tajawal', Arial, sans-serif;
            direction: rtl;
            line-height: 1.6;
            background-color: #f7f7f7;
            padding: 20px;
        }
        .content {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>مرحبًا {{ $user->name }} 👋</h2>
        <p>يسعدنا انضمامك إلى <strong>Gaza Store</strong>.</p>
        <p>نتمنى لك تجربة تسوّق رائعة ومليئة بالعروض والتخفيضات 🛍️</p>
        <p>📦 لا تتردد في تصفّح منتجاتنا الجديدة وطلب ما يناسبك.</p>
        <p>مع تحيات فريق <strong>Gaza Store</strong> 💙</p>
    </div>
</body>
</html>
