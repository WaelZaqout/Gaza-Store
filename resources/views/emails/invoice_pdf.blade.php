<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Tajawal', Arial, sans-serif; direction: rtl; }
    </style>
</head>
<body>
    <h2>فاتورة رقم #{{ $invoice->invoice_number }}</h2>
    <p>اسم العميل: {{ $invoice->user->name }}</p>
    <p>المبلغ: {{ $invoice->total }} $</p>
    <p>التاريخ: {{ $invoice->invoice_date }}</p>
    <p>الحالة: {{ $invoice->status }}</p>
</body>
</html>
