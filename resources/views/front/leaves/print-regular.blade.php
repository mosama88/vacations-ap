@php
    use App\Enum\StatusActive;
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-employeePanel', 'active')
@section('title', 'الصفحة الرئيسية')
@section('css')

@section('css')
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
    <style>
        .custom-underline {
            display: inline-block;
            position: relative;
            padding-bottom: 3px;
        }

        .custom-underline::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            border-bottom: 3px double #000;
        }
    </style>
@endsection

@endsection
@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="col-12  my-4">
                        <button type="button" onclick="printForm()" id="print_Button" class="btn btn-danger no-print">
                            <i class="fas fa-print"></i> طباعة النموذج
                        </button>
                    </div>
                    <div class="row my-2">
                        <div class="col-6">
                            <h5>نموذج الاجازات - بإدارة النيابات</h5>
                            <span class="text-center col-12">وحدة التحول الرقمى</span>
                        </div>
                        <div class="col-6 text-right">
                            <img src="{{ asset('dashboard') }}/assets/dist/img/v-apa.png" alt="AdminLTE Logo"
                                class="img-circle elevation-3" style="opacity: .8;width:100px">
                        </div>

                    </div>
                    <div class="p-4">
                        <h2 class="text-center mb-5">(إجازة إعتيادى)</h2>
                        <div class="row mb-4">
                            <div class="col-6">
                                <span class="form-label">الاسم/ </span>
                                {{ $employees->name }}
                            </div>

                            <div class="col-6">

                                <span class="form-label">الوظيفه/ </span>
                                {{ $employees->jobGrade->name }}
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <span class="form-label">جهه العمل/ </span>
                                {{ $employees->branch->name }}
                            </div>

                            <div class="col-6">
                                <span class="form-label">مدة الأجازه/ </span>
                                {{ $leave->days_taken }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-8">
                                <p>من يوم <span class="mr-4"></span> الموافق {{ $leave->start_date }} حتى يوم <span
                                        class="mr-4"></span>
                                    الموافق
                                    {{ $leave->end_date }} </p>
                                </br>
                                <p>يوم الراحه الاسبوعية {{ $employees->week->name }} الموافق </p>
                            </div>
                            <div class="col-4 mt-5">
                                <p>"أسم القائم بالأعمال" </p>
                                <p>أتعهد أنا بالقيام بالعمل أثناء الاجازه..........................</p>
                            </div>
                        </div>




                        <div class="row mb-3">
                            <div class="col-10">
                                <p>هل الأيام المقدم عنها الاجازه صاده يوم تفتيش مفاجىء على الوحدة: (نعم / لا) :
                                    ..................</p>
                                <p>توقيع طالب الاجازه : .......................................</p>

                            </div>
                        </div>

                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">الاجازه المستحقه من السنه الحالية</th>
                                        <th scope="col">الاجازه السابق منحها فى السنه الحالية</th>
                                        <th scope="col">الرصيد المتبقى من السنه الحالية</th>
                                        <th scope="col">رصيد السنوات السابقه</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $employees->leaveBalance->total_days }}</td>
                                        <td class="text-center">{{ $employees->leaveBalance->used_days }}</td>
                                        <td class="text-center">{{ $employees->leaveBalance->remainig_days }}</td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                        <div class="row mb-3">
                            <div class="col-10">
                                <span>مسئول شئون عاملين : ...............................................</span>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-8">
                                <span>تحريرآ فى </span><span class="m-2"></span> <span class="m-2"> / </span>
                                <span class="m-4"> / <span class="m-4">20 </span>
                                </span>

                            </div>

                            <div class="col-4">
                                <span>نائب رئيس الهيئة </span></br>
                                <span> مدير</span> <br>
                                <span>المستشار / </span><span>.....................................</span>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col-10">
                                <span>مدير السكرتارية</span></br>
                                <span>.............................................</span>
                            </div>
                        </div>

                        <span class="col-12 text-center mb-2"
                            style="border-bottom: 3px double #000; display: inline-block; padding-bottom: 2px">
                        </span>
                        <div class="row">
                            <span class="col-12 text-center mb-2">إقرار القيام</span>

                            <p>أقر أنا / .......................................................بأننى أتممت أعمالى
                                المصلحة اليوم <span>الموافق
                                    <span class="m-5"></span>
                                </span> و هو آخر يوم من أيام العمل.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <span>توقيع الموظف </span> <br>
                                <span>.............................................</span>
                            </div>
                            <div class="col-4">
                                <span>مدير السكرتارية </span> <br>
                                <span>.............................................</span>
                            </div>
                        </div>
                        <span class="col-12 text-center mb-2"
                            style="border-bottom: 3px double #000; display: inline-block; padding-bottom: 2px">
                        </span>
                        <div class="row">
                            <span class="col-12 text-center mb-2">إقرار عودة</span>

                            <p>أقر أنا / .......................................................بأننى أستلمت العمل اليوم
                                الموافق <span>الموافق
                                    <span class="m-5"></span>
                                </span> بعد أنتهاء الاجازه (الاعتيادى - المرضى) الممنوحة لى من <span
                                    class="m-5"></span> حتى <span class="m-5"></span> .
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <span>توقيع الموظف </span> <br>
                                <span>.............................................</span>
                            </div>
                            <div class="col-4">
                                <span>مدير السكرتارية </span> <br>
                                <span>.............................................</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@push('js')
<script>
    function printForm() {
        window.print();
    }
</script>
@endpush
