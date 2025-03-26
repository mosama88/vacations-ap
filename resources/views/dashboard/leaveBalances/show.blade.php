@extends('dashboard.layouts.master')
@section('active-leaveBalances', 'active')
@section('title', 'عرض رصيد الأجازات')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض رصيد الأجازات',
        'previousPage' => 'جدول رصيد الأجازات',
        'urlPreviousPage' => 'leaveBalances.index',
        'currentPage' => 'عرض رصيد الأجازات',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">عرض رصيد الأجازات</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">اسم رصيد الأجازات</label>
                                <input type="text" name="name" value="{{ old('name', $branch->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                    placeholder="أدخل رصيد الأجازات">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectBorder">المحافظة التابع لها <code>رصيد الأجازات</code></label>
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
