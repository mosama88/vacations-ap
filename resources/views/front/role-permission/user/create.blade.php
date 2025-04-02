@extends('dashboard.layouts.master')
@section('active-users', 'active')
@section('title', 'تعديل بيانات المستخدم')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل بيانات المستخدم',
        'previousPage' => 'جدول المستخدمين',
        'urlPreviousPage' => 'users.index',
        'currentPage' => 'تعديل بيانات المستخدم',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">تعديل بيانات المستخدم</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">

                            <form action="{{ url('users') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="">الأسم</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">أسم المستخدم</label>
                                    <input type="text" name="username" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">كلمة المرور</label>
                                    <input type="password" name="password" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">الصلاحيات</label>
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value="">حدد الصلاحية</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Submit --}}
                                <div class="row row-xs wd-xl-80p">
                                    <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><button type="submit"
                                            class="btn btn-success btn-with-icon btn-block"><i class="typcn typcn-edit"></i>
                                            تأكيد
                                            البيانات</button>
                                    </div>
                                    <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><a href="{{ url('users') }}"
                                            type="submit" class="btn btn-info btn-with-icon btn-block"><i
                                                class="typcn typcn-arrow-back-outline"></i> رجوع</a></div>
                                </div>
                            </form>
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
