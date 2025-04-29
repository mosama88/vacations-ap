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
                                    href="{{ route('dashboard.financeCalendars.open', $info->id) }}" id="openYearLink">
                                    <button type="button" id="openYearButton" class="btn btn-primary">
                                        <i class="mx-1 fas fa-lock-open"></i> فتح السنه
                                        <span id="spinnerOpen" class="spinner-border spinner-border-sm"
                                            style="display: none;"></span>
                                    </button>
                                </a>
                            @elseif ($info->status === App\Enum\StatusActive::Active)
                                <a class="dropdown-item text-secondary"
                                    href="{{ route('dashboard.financeCalendars.close', $info->id) }}" id="closeYearLink">
                                    <button type="button" id="closeYearButton" class="btn btn-secondary">
                                        <i class="mx-1 fas fa-lock"></i> غلق السنه
                                        <span id="spinnerClose" class="spinner-border spinner-border-sm"
                                            style="display: none;"></span>
                                    </button>
                                </a>
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
    <script src="{{ asset('dashboard') }}/assets/dist/js/sweetalert2@11.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Open Year Logic
            const openYearButton = document.getElementById('openYearButton');
            const openYearLink = document.getElementById('openYearLink');
            const spinnerOpen = document.getElementById('spinnerOpen');

            if (openYearButton && openYearLink) {
                openYearButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default action

                    // Show SweetAlert confirmation before proceeding
                    Swal.fire({
                        title: 'هل تريد فتح السنة الآن؟',
                        text: 'لا يمكن التراجع عن هذا الإجراء!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'نعم، فتح السنة',
                        cancelButtonText: 'إلغاء'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Disable the button and show spinner
                            openYearButton.disabled = true;
                            if (spinnerOpen) spinnerOpen.style.display = 'inline-block';

                            // Perform the action (navigate to the route)
                            setTimeout(function() {
                                window.location.href = openYearLink.href;
                            }, 1000); // Delay before navigating
                        }
                    });
                });
            }

            // Close Year Logic
            const closeYearButton = document.getElementById('closeYearButton');
            const closeYearLink = document.getElementById('closeYearLink');
            const spinnerClose = document.getElementById('spinnerClose');

            if (closeYearButton && closeYearLink) {
                closeYearButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default action

                    // Show SweetAlert confirmation before proceeding
                    Swal.fire({
                        title: 'هل تريد غلق السنة الآن؟',
                        text: 'لا يمكن التراجع عن هذا الإجراء!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'نعم، غلق السنة',
                        cancelButtonText: 'إلغاء'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Disable the button and show spinner
                            closeYearButton.disabled = true;
                            if (spinnerClose) spinnerClose.style.display = 'inline-block';

                            // Perform the action (navigate to the route)
                            setTimeout(function() {
                                window.location.href = closeYearLink.href;
                            }, 1000); // Delay before navigating
                        }
                    });
                });
            }
        });
    </script>
@endpush
