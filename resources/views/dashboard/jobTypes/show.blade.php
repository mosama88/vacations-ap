@extends('dashboard.layouts.master')
@section('active-jobTypes', 'active')
@section('title', 'عرض نوع الوظيفه')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض نوع الوظيفه',
        'previousPage' => 'جدول نوع الوظيفه',
        'urlPreviousPage' => 'jobTypes.index',
        'currentPage' => 'عرض نوع الوظيفه',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">عرض نوع الوظيفه</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">اسم نوع الوظيفه</label>
                                <input type="text" name="name" value="{{ old('name', $jobType->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                    placeholder="أدخل نوع الوظيفه">
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->



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
