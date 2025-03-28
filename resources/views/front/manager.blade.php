@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-dashboard', 'active')
@section('title', 'الصفحة الرئيسية')
@section('content')


    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'بروفايل المدير',
        'previousPage' => '',
        'urlPreviousPage' => '',
        'currentPage' => 'الصفحه الرئيسية',
    ])




    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="col-12 float-right">جدول أجازات <span
                                    class="text-secondary">{{ Auth::user()->name }}</span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>كود الأجازه</th>
                                        <th>نوع الأجازه</th>
                                        <th>بداية الاجازه</th>
                                        <th>نهاية الاجازه</th>
                                        <th>عدد الأيام</th>
                                        <th>حالة الاجازه</th>
                                        <th>ملاحظات</th>
                                        <th>انشاء بواسطة</th>
                                        <th>تحديث بواسطة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($info->leave_type == LeaveTypeEnum::Emergency)
                                                    عارضه
                                                @elseif ($info->leave_type == LeaveTypeEnum::Regular)
                                                    إعتيادى
                                                @elseif ($info->leave_type == LeaveTypeEnum::Annual)
                                                    سنوى
                                                @else
                                                    مرضى
                                                @endif
                                            </td>
                                            <td>{{ $info->start_date }}</td>
                                            <td>{{ $info->end_date }}</td>
                                            <td>{{ $info->days_taken * 1 }}</td>
                                            <td>
                                                @if ($info->leave_status == LeaveStatusEnum::Approved)
                                                    موافق
                                                @elseif ($info->leave_status == LeaveStatusEnum::Pending)
                                                    معلقه
                                                @else
                                                    مرفوض
                                                @endif
                                            </td>
                                            <td>{{ $info->description }}</td>
                                            <td>{{ $info->created_by ? $info->createdBy->name : 'لا يوجد' }}</td>
                                            <td>{{ $info->updated_by ? $info->updatedBy->name : 'لا يوجد تحديث' }}</td>
                                        @empty
                                            لا توجد أجازات
                                    @endforelse
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->


                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
