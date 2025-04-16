@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', '403')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => '403',
        'previousPage' => 'الصفحة الرئيسية',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => '403',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="error-page">
            <h2 class="headline text-dark"> 403</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-dark"></i> Oops! You Don't Have Permission.</h3>

                <p>
                    المستخدم ليس لديه الصلاحيات .
                    تواصل مع الدعم الفنى <a href="{{ route('dashboard.employee-panel.index') }}">ارجع الى الصفحه الرئيسية</a>

                </p>


            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
@endsection
