
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الصفحة غير موجودة - 404</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-container {
            text-align: center;
        }

        .error-code {
            font-size: 10rem;
            font-weight: bold;
            color: #dc3545;
        }

        .error-message {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container error-container">
        <div class="error-code">404</div>
        <div class="error-message">عذرًا، الصفحة التي تبحث عنها غير موجودة.</div>
        <a href="{{ route('dashboard.employee-panel.index') }}" class="btn btn-primary">العودة إلى الصفحة الرئيسية</a>
    </div>
</body>

</html>
