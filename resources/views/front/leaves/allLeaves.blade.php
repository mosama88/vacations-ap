@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-all', 'active')
@section('title', 'أجازات الموظف')
@section('content')


    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'أجازات الموظف',
        'previousPage' => '',
        'urlPreviousPage' => '',
        'currentPage' => 'أجازات الموظف',
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
                                            <td>{{ $info->leave_code }}</td>
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
                                                    تم الموافقه
                                                @elseif ($info->leave_status == LeaveStatusEnum::Pending)
                                                    معلقه
                                                @else
                                                    مرفوض
                                                @endif

                                            </td>

                                            @include('front.leaves.edit')
                                            <td>{{ $info->description }}</td>
                                            <td>{{ $info->created_by ? $info->createdBy->name : 'لا يوجد' }}</td>
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
