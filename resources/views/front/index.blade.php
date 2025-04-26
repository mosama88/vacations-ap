@php
    use App\Enum\StatusActive;
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-employeePanel', 'active')
@section('title', 'الصفحة الرئيسية')
@section('content')


    @include('dashboard.layouts.message')


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $approvedLeaves }}</h3>

                            <p>إجمالى الأجازات</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $pendingLeaves }}<sup style="font-size: 20px"></sup></h3>

                            <p>إجمالى الأجازات المعلقه</p>

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
                            <h3>{{ $branch_employees }}</h3>

                            <p>إجمالى الموظفين بالنيابه</p>
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
                                لسنة
                                <span class="text-secondary"> {{ $financial_year->finance_yr ?? null }}</span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class=" my-2">
                                @can('المعلقه الأجازات')
                                    <a href="{{ route('dashboard.leaves.getLeavespending') }}" class="btn btn-warning mx-1"> <i
                                            class="fas fa-hourglass-half mx-1"></i> الأجازات المعلقه </a>
                                @endcan
                                @if ($financial_year?->status == StatusActive::Active)
                                    @can('طلب الأجازات')
                                        <a href="{{ route('dashboard.leaves.create') }}" class="btn btn-primary mx-1"><i
                                                class="fas fa-hand-paper mx-1"></i> طلب أجازه</a>
                                    @endcan
                                @else
                                    لا توجد سنه مالية مفتوحة
                                @endif

                                @can('الموظفين الأجازات')
                                    <a href="{{ route('dashboard.leaves.index') }}" class="btn btn-success mx-1"><i
                                            class="fas fa-clipboard-list mx-1"></i> الاجازاه التى أخذت أجراء</a>
                                @endcan
                            </div>
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
                                        <th>الأجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $info->leave_code }}</td>
                                            <td>
                                                @if ($info->leave_type == LeaveTypeEnum::Emergency)
                                                    عارضه
                                                @elseif ($info->leave_type == LeaveTypeEnum::Regular)
                                                    إعتيادى
                                                @elseif ($info->leave_type == LeaveTypeEnum::Annual)
                                                    اجازه سنوية
                                                @else
                                                    مرضى
                                                @endif
                                            </td>
                                            <td>{{ $info->start_date }}</td>
                                            <td>{{ $info->end_date }}</td>
                                            <td>{{ $info->days_taken * 1 }}</td>
                                            <td>
                                                @if ($info->leave_status == LeaveStatusEnum::Approved)
                                                    <span class="badge bg-primary">موافق</span>
                                                @elseif ($info->leave_status == LeaveStatusEnum::Pending)
                                                    <span class="badge bg-warning">معلقه</span>
                                                @else
                                                    <span class="badge bg-danger">مرفوض</span>
                                                @endif
                                            </td>

                                            <td>{{ Str::limit($info->description, 20) }}</td>
                                            <td>{{ $info->created_by ? $info->createdBy->name : 'لا يوجد' }}</td>
                                            <td>{{ $info->updated_by ? $info->updatedBy->name : 'لا يوجد تحديث' }}</td>
                                            <td>
                                                @if ($info->leave_status != LeaveStatusEnum::Approved)
                                                    <a class="btn btn-outline-info btn-sm mx-2"
                                                        href="{{ route('dashboard.leaves.edit', $info->id) }}"><i
                                                            class="fas fa-edit ml-1"></i></a>
                                                @endif
                                                <a class="btn btn-outline-success btn-sm mx-2"
                                                    href="{{ route('dashboard.leaves.show', $info->id) }}"><i
                                                        class="fas fa-eye ml-1"></i></a>

                                                {{-- طباعه --}}
                                                @if ($info->leave_status === LeaveStatusEnum::Approved)
                                                    <a class="btn btn-outline-dark btn-sm mx-2"
                                                        href="{{ route('dashboard.leaves.print', $info->id) }}"><i
                                                            class="fas fa-print"></i></a>
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-info" role="alert">
                                            !!لا توجد أجازات
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $data->links() }}
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
@push('js')
@endpush
