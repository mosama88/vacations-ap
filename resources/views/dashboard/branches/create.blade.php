@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'أنشاء فرع جديد')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'أنشاء فرع جديد',
        'previousPage' => 'جدول الفروع',
        'urlPreviousPage' => 'branches.index',
        'currentPage' => 'أنشاء فرع جديد',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">أنشاء فرع جديد</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.branches.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">اسم الفرع</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                        placeholder="أدخل فرع جديد">
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
                                            <option @if (old('governorate_id') == $governorate->id) selected @endif
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
