@extends('dashboard.layouts.master')
@section('active-jobGrades', 'active')
@section('title', 'تعديل الدرجه الوظيفية')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل الدرجه الوظيفية',
        'previousPage' => 'جدول الدرجات الوظيفية',
        'urlPreviousPage' => 'jobGrades.index',
        'currentPage' => 'تعديل الدرجه الوظيفية',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">تعديل الدرجه الوظيفية</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.jobGrades.update', $jobGrade->slug) }}" method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">اسم الدرجه الوظيفية</label>
                                    <input type="text" name="name" value="{{ old('name', $jobGrade->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                        placeholder="أدخل الدرجه">
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
                        <button type="submit" id="submitButton" class="btn btn-info">تعديل البيانات <i
                                class="fas fa-save mx-1"></i>
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
@push('js')
    <script>
        document.getElementById('editForm').addEventListener('submit', function(event) {
            var submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.innerHTML = 'جاري التعديل...'; // Optional: Change text while submitting
        });
    </script>
@endpush
