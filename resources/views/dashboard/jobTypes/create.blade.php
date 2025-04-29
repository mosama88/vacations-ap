@extends('dashboard.layouts.master')
@section('active-jobTypes', 'active')
@section('title', 'أنشاء نوع وظيفه جديدة')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'أنشاء نوع وظيفه جديدة',
        'previousPage' => 'جدول نوع الوظيفه',
        'urlPreviousPage' => 'jobTypes.index',
        'currentPage' => 'أنشاء نوع وظيفه جديدة',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">أنشاء نوع وظيفه جديدة</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.jobTypes.store') }}" method="POST" id="storeForm">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">اسم نوع الوظيفه</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                        placeholder="أدخل اسم نوع الوظيفه">
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
                        <button type="submit" class="btn btn-primary" id="submitButton">حفظ البيانات <i
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
        document.getElementById('storeForm').addEventListener('submit', function(event) {
            var submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.innerHTML = 'جاري الحفظ...'; // Optional: Change text while submitting
        });
    </script>
@endpush
