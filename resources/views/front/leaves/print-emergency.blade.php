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
                    <div class="row my-3">
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
                        <h2 class="text-center mb-5">(إجازة عارضة)</h2>
                        <div class="row mb-4">
                            <div class="col-6">
                                <span class="form-label">الاسم/ </span>
                                {{ $employees->name }}
                            </div>

                            <div class="col-6">

                                <span class="form-label">الوظيفه/ </span>
                                {{ $employees->jobType->name }}
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

                        <div class="row mb-4">
                            <div class="col-10">
                                <p>يوم <span class="mr-4"></span> الموافق {{ $leave->start_date }} الى يوم <span
                                        class="mr-4"></span> الموافق
                                    {{ $leave->end_date }} </p>
                                <p>يوم الراحه الاسبوعية {{ $employees->week->name }} الموافق <span
                                        class="mr-4"></span> </p>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-10">
                                <p>هل الأيام المقدم عنها الاجازه صاده يوم تفتيش مفاجىء على الوحدة: (نعم / لا) :
                                    ..................</p>
                            </div>
                        </div>

                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">الاجازه المستحقه من السنه الحالية</th>
                                        <th scope="col">الاجازه السابق منحها فى السنه الحالية</th>
                                        <th scope="col">الرصيد المتبقى من السنه الحالية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $employees->leaveBalance->total_days_emergency }}
                                        </td>
                                        <td class="text-center">{{ $employees->leaveBalance->used_days_emergency }}</td>
                                        <td class="text-center">{{ $employees->leaveBalance->remainig_days_emergency }}
                                        </td>
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
                            <div class="col-6">
                                <span>تحريرآ فى </span></br>
                                <span> </span>
                                <span class="m-2"> / </span> <span class="m-4"> / <span class="m-4">20 </span>
                                </span>
                            </div>

                            <div class="col-6 text-right">
                                <span class="text-center col-6">توقيع طالب الاجازه </span></br>
                                <span> </span>
                                <span>الاسم ثلاثى / </span><span>.....................................</span>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col-10">
                                <span>المدير الادارى</span></br>
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
