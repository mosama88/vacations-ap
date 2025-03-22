@extends('dashboard.layouts.master')
@section('active-dashboard', 'active')
@section('title', 'الصفحة الرئيسية')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'السنوات المالية',
        'previousPage' => 'لوحة التحكم',
        'urlPreviousPage' => 'index',
        'currentPage' => 'جدول السنوات المالية',
    ])


    <section class="content">
        <div class="container-fluid">


            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
