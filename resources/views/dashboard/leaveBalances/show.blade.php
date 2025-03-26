@extends('dashboard.layouts.master')
@section('active-leaveBalances', 'active')
@section('title', 'عرض رصيد الأجازات')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض رصيد الأجازات',
        'previousPage' => 'جدول رصيد الأجازات',
        'urlPreviousPage' => 'leaveBalances.index',
        'currentPage' => 'عرض رصيد الأجازات',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">عرض رصيد الأجازات</h3>
                            <span>{{ $leaveBalance->financeCalendar->finance_yr }}</span>

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">

                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>أسم الموظف</th>
                                        <th>السنه</th>
                                        <th>رصيد</th>
                                        <th>الرصيد المستخدم</th>
                                        <th>الرصيد المتبقى</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $leaveBalance->iteration }}</td>
                                        <td>{{ $leaveBalance->employee->name }}</td>
                                        <td>{{ $leaveBalance->financeCalendar->finance_yr }}</td>
                                        <td>{{ $leaveBalance->total_days }}</td>
                                        <td>{{ $leaveBalance->used_days }}</td>
                                        <td>{{ $leaveBalance->remainig_days }}</td>
                                    </tr>

                                </tbody>
                            </table>


                        </div>

                    </div>
                    <!-- /.card-body -->



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
