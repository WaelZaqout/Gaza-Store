<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تم الدفع بنجاح</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'تم الدفع بنجاح!',
                text: 'سيتم تحويلك إلى المتجر خلال ثوانٍ...',
                showConfirmButton: false,
                timer: 3000
            });

            // إعادة التوجيه بعد 3 ثوانٍ
            setTimeout(function () {
                window.location.href = "{{ route('front.index') }}";
            }, 3000);
        });
    </script>
</head>
<body style="background-color: #f5f5f5;">
</body>
</html>
