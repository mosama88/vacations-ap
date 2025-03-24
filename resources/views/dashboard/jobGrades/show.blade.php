@extends('dashboard.layouts.master')
@section('active-jobGrades', 'active')
@section('title', 'عرض الدرجه الوظيفية')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض الدرجه الوظيفية',
        'previousPage' => 'جدول الفروع',
        'urlPreviousPage' => 'jobGrades.index',
        'currentPage' => 'عرض الدرجه الوظيفية',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">عرض الدرجه الوظيفية</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">اسم الدرجه الوظيفية</label>
                                <input type="text" name="name" value="{{ old('name', $jobGrade->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                    placeholder="أدخل الدرجه الوظيفية">
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
