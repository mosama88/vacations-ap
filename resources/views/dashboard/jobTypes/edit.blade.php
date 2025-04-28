@extends('dashboard.layouts.master')
@section('active-jobTypes', 'active')
@section('title', 'تعديل نوع الوظيفه')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل نوع الوظيفه',
        'previousPage' => 'جدول نوع الوظيفه',
        'urlPreviousPage' => 'jobTypes.index',
        'currentPage' => 'تعديل نوع الوظيفه',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">تعديل نوع الوظيفه</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.jobTypes.update', $jobType->slug) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">اسم نوع الوظيفه</label>
                                    <input type="text" name="name" value="{{ old('name', $jobType->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                        placeholder="أدخل نوع الوظيفه">
                                    @error('name')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-center ">
                        <button type="submit" class="btn btn-primary">حفظ البيانات <i class="fas fa-save mx-1"></i>
                        </button>
                    </div>
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
