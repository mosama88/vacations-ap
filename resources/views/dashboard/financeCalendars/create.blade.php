@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'أنشاء السنه المالية')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'أنشاء السنوات المالية',
        'previousPage' => 'جدول السنوات المالية',
        'urlPreviousPage' => 'financeCalendars.index',
        'currentPage' => 'أنشاء السنه المالية',
    ])


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">أنشاء السنوات المالية</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.financeCalendars.store') }}" method="POST" id="storeForm">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">اسم السنه المالية</label>
                                    <input type="text" name="finance_yr" value="{{ old('finance_yr') }}"
                                        class="form-control @error('finance_yr') is-invalid @enderror" id="exampleInputName"
                                        placeholder="أدخل السنه المالية">
                                    @error('finance_yr')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputfinance_yr_desc">وصف السنه المالية</label>
                                    <input type="text" name="finance_yr_desc" value="{{ old('finance_yr_desc') }}"
                                        class="form-control @error('finance_yr_desc') is-invalid @enderror"
                                        id="exampleInputfinance_yr_desc" placeholder="أدخل وصف السنه المالية">
                                    @error('finance_yr_desc')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group col-4">
                                        <label class="visually-hidden" for="specificSizeInputGroupUsername">بداية
                                            السنه</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                            <input type="text" id="start_date" name="start_date"
                                                class="form-control bg-white  @error('start_date') is-invalid @enderror"
                                                value="{{ old('start_date') }}" placeholder="اختر تاريخ البداية">
                                            @error('start_date')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group col-4">
                                        <label class="visually-hidden" for="specificSizeInputGroupUsername">نهاية
                                            السنه</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                            <input type="text" id="end_date" name="end_date"
                                                class="form-control bg-white  @error('end_date') is-invalid @enderror"
                                                value="{{ old('end_date') }}" placeholder="اختر تاريخ النهاية">
                                            @error('end_date')
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
                                <button type="submit" id="submitButton" class="btn btn-primary">حفظ البيانات <i
                                        class="fas fa-save mx-1"></i>
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
    <script>
        // تفعيل Flatpickr مع اللغة العربية
        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            locale: "ar",
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            locale: "ar",
        });
    </script>
    <script>
        document.getElementById('storeForm').addEventListener('submit', function(event) {
            var submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.innerHTML = 'جارى الحفظ ...'; // Optional: Change text while submitting
        });
    </script>
@endpush
