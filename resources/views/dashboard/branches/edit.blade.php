@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'تعديل الفرع')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل الفرع',
        'previousPage' => 'جدول الفروع',
        'urlPreviousPage' => 'branches.index',
        'currentPage' => 'تعديل الفرع',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">تعديل الفرع</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.branches.update', $branch->slug) }}" method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">اسم الفرع</label>
                                    <input type="text" name="name" value="{{ old('name', $branch->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                        placeholder="أدخل فرع">
                                    @error('name')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectBorder">المحافظة التابع لها <code>الفرع</code></label>
                                    <select name="governorate_id"
                                        class="custom-select form-control-border @error('governorate_id') is-invalid @enderror"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر المحافظة --</option>
                                        @forelse ($other['governorates'] as $governorate)
                                            <option @if (old('governorate_id', $branch->governorate_id) == $governorate->id) selected @endif
                                                value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                        @empty
                                            عفوآ لا توجد بيانات!
                                        @endforelse
                                    </select>
                                    @error('governorate_id')
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
