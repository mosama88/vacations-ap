@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'الملف الشخصى')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'الملف الشخصى',
        'previousPage' => 'الملف الشخصى',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'الملف الشخصى',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-8 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">الملف الشخصى</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.profile') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row  mx-auto">
                                    <div class="form-group col-4">
                                        <label for="exampleInputName">كلمة المرور الجديدة</label>
                                        <input type="text" name="password" value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="exampleInputpassword" placeholder="مثال:**************">
                                        @error('password')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleInputName">تأكيد كلمة المرور </label>
                                        <input type="text" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="exampleInputpassword_confirmation"placeholder="مثال: تأكيد **************">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="card-footer text-center ">
                                <button type="submit" class="btn btn-primary">تغيير كلة المرور <i
                                        class="fas fa-save mx-1"></i>
                                </button>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    </form>
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
