@extends('dashboard.layouts.master')
@section('active-leaveBalances', 'active')
@section('title', 'تعديل رصيد الأجازات')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل رصيد الأجازات',
        'previousPage' => 'جدول رصيد الأجازات',
        'urlPreviousPage' => 'leaveBalances.index',
        'currentPage' => 'تعديل رصيد الأجازات',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">تعديل رصيد الأجازات لسنه
                                <span>{{ $leaveBalance->financeCalendar->finance_yr }}</span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.leaveBalances.update', $leaveBalance->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleSelectBorder">أسم الموظف </label>
                                        <select name="employee_id"
                                            class="form-control select2 vh-100 @error('employee_id') is-invalid @enderror"
                                            id="exampleSelectBorder">
                                            <option value="">-- أختر الموظف --</option>
                                            @forelse ($other['employees'] as $employee)
                                                <option @if (old('employee_id', $leaveBalance->employee_id) == $employee->id) selected @endif
                                                    value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @empty
                                                عفوآ لا توجد بيانات!
                                            @endforelse
                                        </select>
                                        @error('employee_id')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName"> الرصيد الأجازات</label>
                                        <input type="text" name="total_days"
                                            value="{{ old('total_days', $leaveBalance->total_days) }}"
                                            class="form-control @error('total_days') is-invalid @enderror"
                                            id="exampleInputtotal_days" placeholder="أدخل رصيد الأجازات ">
                                        @error('total_days')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-center ">
                        <button type="submit" class="btn btn-info">حفظ البيانات <i class="fas fa-save mx-1"></i>
                        </button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->

                <!-- general form elements -->

                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('js')
    <!-- Select2 -->
    <script src="{{ asset('dashboard') }}/assets/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        })
    </script>
@endpush
