@php
    use App\Enum\StatusActive;
@endphp
@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'الصفحة الرئيسية')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'السنوات المالية',
        'previousPage' => 'لوحة التحكم',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'جدول السنوات المالية',
    ])

    @include('dashboard.layouts.message')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('dashboard.financeCalendars.create') }}"
                                    class="btn btn-block text-white btn-success"> <i class="fas fa-plus-circle mx-1"></i>
                                    أنشاء</a>
                            </h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-head-fixed text-nowrap table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>السنه المالية</th>
                                        <th>الوصف</th>
                                        <th>بداية السنه</th>
                                        <th>نهاية السنه</th>
                                        <th>الحالة</th>

                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $info->finance_yr }}</td>
                                            <td>{{ $info->finance_yr_desc }}</td>
                                            <td>{{ $info->start_date }}</td>
                                            <td>{{ $info->end_date }}</td>
                                            <td>
                                                @if ($info->status === StatusActive::Active)
                                                    <span class="badge bg-success">السنه مفتوحة</span>
                                                @elseif($info->status === StatusActive::Inactive)
                                                    <span class="badge bg-warning">السنه غير مفعله</span>
                                                @else
                                                    <span class="badge bg-danger">السنه مؤرشفه</span>
                                                @endif
                                            </td>

                                            <td class="project-actions">
                                                @include('dashboard.partials.action', [
                                                    'name' => 'financeCalendars',
                                                    'name_id' => $info,
                                                ])
                                                </ul>
                        </div>
                        </td>
                        <td>
                            @if ($info->status === App\Enum\StatusActive::Inactive)
                                <a class="dropdown-item text-success"
                                    href="{{ route('dashboard.financeCalendars.open', $info->id) }}">
                                    <i class="mx-1 fas fa-lock-open"></i> فتح
                                    السنه</a>
                            @elseif ($info->status === App\Enum\StatusActive::Active)
                                <a class="dropdown-item text-secondary"
                                    href="{{ route('dashboard.financeCalendars.close', $info->id) }}">
                                    <i class="mx-1 fas fa-lock"></i> غلق
                                    السنه</a>
                            @else
                            @endif
                        </td>
                        </tr>
                    @empty
                        <div class="alert alert-primary" role="alert">
                            عفوآ لاتوجد بيانات
                            !
                        </div>
                        @endforelse
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
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endpush
