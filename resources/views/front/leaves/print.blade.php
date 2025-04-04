<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إجازة عارضة</title>
    <!-- إضافة رابط Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body {
                font-size: 16px;
                text-align: right;
                direction: rtl;
            }

            /* إخفاء بعض العناصر التي لا نريد طباعتها */
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="border p-4">
                    <h2 class="text-center mb-4">إجازة عارضة</h2>

                    <div class="mb-3">
                        <label class="form-label">الاسم:</label>
                        <input type="text" class="form-control" value="{{ $employees->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الوظيفة:</label>
                        <input type="text" class="form-control" value="{{ $employees->jobGrade->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">جهة العمل:</label>
                        <input type="text" class="form-control" value="{{ $employees->branch->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">مدة الإجازة:</label>
                        <input type="text" class="form-control" value="{{ $leave->days_taken }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الموافقة:</label>
                        <input type="text" class="form-control" value="الموافقة على الإجازة في: ............"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">هل الأيام المقدمة عنها الإجازة مصادفة يوم تشغيل مفاجئ على
                            الوحدة؟</label>
                        <input type="text" class="form-control" value="(نعم / لا)" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الإدارة السابقة محفوظة في السنة الحالية:</label>
                        <input type="text" class="form-control" value="7" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الإدارة الحالية محفوظة في السنة الحالية:</label>
                        <input type="text" class="form-control" value="3" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الرصيد المتبقي من السنة الحالية:</label>
                        <input type="text" class="form-control" value="3" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">مستند شؤون العاملين:</label>
                        <input type="text" class="form-control" value=".................." readonly>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <p class="mb-0">توقيع طلب الإجازة:</p>
                            <input type="text" class="form-control" value=".................." readonly>
                        </div>
                        <div>
                            <p class="mb-0">الاسم:</p>
                            <input type="text" class="form-control" value=".................." readonly>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <p class="mb-0">توقيع المدير الإداري:</p>
                        <input type="text" class="form-control" value=".................." readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- إضافة رابط JavaScript الخاص بـ Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        window.print(); // هذا سيبدأ عملية الطباعة مباشرة
    </script>
</body>

</html>
