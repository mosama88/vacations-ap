@php
    use App\Enum\StatusActive;
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-employeePanel', 'active')
@section('title', 'الصفحة الرئيسية')
@section('css')
    <style>
        @media print {
            body {
                font-size: 16px;
                text-align: right;
                direction: rtl;
            }

            /* إخفاء العناصر غير المرغوب فيها */
            header,
            footer,
            .no-print {
                display: none;
            }
        }
    </style>
@endsection
@section('content')


    @include('dashboard.layouts.message')


    <section class="content">
        <div class="container-fluid">

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="col-12 my-4">
                            <button type="button" onclick="window.print()" class="print-button btn btn-danger"><i
                                    class="fas fa-print"></i>
                                طباعة</button>
                        </div>

                        <div class="border p-4">
                            <h2 class="text-center mb-4">إجازة عارضة</h2>

                            <div class="mb-3">
                                <label class="form-label">الاسم:</label>
                                <input type="text" class="form-control" value="{{ $employees->name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الوظيفة:</label>
                                <input type="text" class="form-control" value="{{ $employees->jobGrade->name }}"
                                    readonly>
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




        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('js')
    <script type="text/javascript">
        window.print(); // هذا سيبدأ عملية الطباعة مباشرة
    </script>
@endpush
