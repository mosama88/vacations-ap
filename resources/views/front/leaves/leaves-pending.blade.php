@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-pending', 'active')
@section('title', 'الاجازات المعلقه')
@section('content')


    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'الاجازات المعلقه',
        'previousPage' => 'لوحة التحكم',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'الاجازات المعلقه',
    ])
    @include('dashboard.layouts.message')




    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <!-- /.row -->
            <!-- Main row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="col-12 float-right">جدول أجازات <span class="text-secondary">الموظفين المعلقه</span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>كود الأجازه</th>
                                        <th>مقدم الأجازه</th>
                                        <th>نوع الأجازه</th>
                                        <th>بداية الاجازه</th>
                                        <th>نهاية الاجازه</th>
                                        <th>عدد الأيام</th>
                                        <th>حالة الاجازه</th>
                                        <th>ملاحظات</th>
                                        <th>تحديث بواسطة</th>
                                        <th>عرض البيانات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $info->leave_code }}</td>
                                            <td>{{ $info->employee->name }}</td>
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
                                                    <span class="badge bg-primary">موافق</span>
                                                @elseif ($info->leave_status == LeaveStatusEnum::Pending)
                                                    <span class="badge bg-warning">معلقه</span>
                                                    <a class="modal-effect btn btn-info btn-sm" data-toggle="modal"
                                                        href="#editLeaveModal{{ $info->id }}"
                                                        data-id="{{ $info->id }}">
                                                        أخذ إجراء
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">مرفوض</span>
                                                @endif
                                            </td>

                                            @include('front.leaves.edit')
                                            <td>{{ $info->description }}</td>
                                            <td>{{ $info->updated_by ? $info->updatedBy->name : 'لا يوجد تحديث' }}</td>
                                        @empty
                                            لا توجد أجازات
                                    @endforelse
                                    </tr>
                                </tbody>
                            </table>
                            {{-- @include('front.leaves.edit') --}}
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
