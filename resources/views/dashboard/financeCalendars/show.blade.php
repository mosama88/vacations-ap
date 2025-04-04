@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'عرض السنه المالية')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض السنوات المالية',
        'previousPage' => 'جدول السنوات المالية',
        'urlPreviousPage' => 'financeCalendars.index',
        'currentPage' => 'عرض السنه المالية',
    ])


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">عرض السنوات المالية</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">اسم السنه المالية</label>
                                <input disabled type="text" name="finance_yr"
                                    value="{{ old('finance_yr', $financeCalendar['finance_yr']) }}"
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
                                <input disabled type="text" name="finance_yr_desc"
                                    value="{{ old('finance_yr_desc', $financeCalendar['finance_yr_desc']) }}"
                                    class="form-control @error('finance_yr_desc') is-invalid @enderror"
                                    id="exampleInputfinance_yr_desc" placeholder="أدخل وصف السنه المالية">
                                @error('finance_yr_desc')
                                    <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>بداية السنه</label>
                                    <input disabled type="date" name="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date', $financeCalendar['start_date']) }}"
                                        placeholder="أدخل السنه المالية">
                                    @error('start_date')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>نهاية السنه</label>
                                    <input disabled type="date" name="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date', $financeCalendar['end_date']) }}"
                                        placeholder="أدخل السنه المالية">
                                    @error('end_date')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-hover text-nowrap">

                                <thead class="thead-light">
                                    <tr>
                                        <th>اسم الشهر</th>
                                        <th>سنة</th>
                                        <th>تاريخ البداية</th>
                                        <th>تاريخ النهاية</th>
                                        <th>عدد الأيام</th>
                                        <th>حالة الشهر</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finance_cln_periods as $info)
                                        <tr>
                                            <td>{{ $info->month->name['ar'] }}</td>
                                            <td>{{ $info->finance_yr }}</td>
                                            <td>{{ $info->start_date_month }}</td>
                                            <td>{{ $info->end_date_month }}</td>
                                            <td>{{ $info->number_of_days }}</td>
                                            <td>
                                                @if ($info->status === App\Enum\StatusOpen::Pending)
                                                    <a class="badge badge-warning" href="#">معلق</a>
                                                @elseif ($info->status === App\Enum\StatusOpen::Open)
                                                    <a class="badge badge-success" href="#">مفتوح</a>
                                                @else
                                                    <a class="badge badge-danger" href="#">مؤرشف</a>
                                                @endif
                                                @if ($info['status'] != 2)
                                           
                                                    <a class=" btn btn-outline-info btn-sm mx-2" data-toggle="modal"
                                                        data-toggle="modal" href="#editIsOpen{{ $info->id }}"><i
                                                            class="fas fa-edit ml-1"></i></a>
                                                @endif
                                            </td>
                                           
                                            @include('dashboard.financeCalendars.editIsOpen')
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
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
