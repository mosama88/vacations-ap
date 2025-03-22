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
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-hover text-nowrap">

                                <thead class="thead-light">
                                    <tr>
                                        <th>اسم الشهر</th>
                                        <th>سنة</th>
                                        <th>تاريخ البداية</th>
                                        <th>تاريخ النهاية</th>
                                        <th>عدد الأيام</th>
                                        <th>حالة الشهر</th>
                                        <th>الإضافة بواسطة</th>
                                        <th>التحديث بواسطة</th>
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
                                                    {{-- Edit --}}
                                                    <a class=" btn btn-outline-info btn-sm mx-2" data-toggle="modal"
                                                        data-toggle="modal" href="#editIsOpen{{ $info->id }}"><i
                                                            class="fas fa-edit ml-1"></i></a>
                                                @endif
                                            </td>
                                            <td>{{ $info->createdBy->name ?? 'غير معروف' }}</td>
                                            <td>
                                                @if ($info->updated_by > 0 && $info->updatedBy)
                                                    {{ $info->updatedBy->name }}
                                                @else
                                                    <span class="text">لا يوجد</span>
                                                @endif
                                            </td>
                                            @include('dashboard.financeCalendars.editIsOpen')
                                        </tr>
                                        {{-- @include('dashboard.settings.financeCalendars.editISOpen') --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
