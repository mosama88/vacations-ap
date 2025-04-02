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
                            <form action="{{ url('users/' . $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="">الأسم</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="">البريد الالكترونى</label>
                                    <input type="text" name="username" readonly value="{{ $user->username }}"
                                        class="form-control" />
                                </div>

                                <div class="mb-3">
                                    <label for="">كلمة المرور</label>
                                    <input type="password" name="password" class="form-control" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="">الصلاحيات</label>
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value="">حدد الصلاحية</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status">حالة الحساب</label>
                                    <select name="status" class="form-control select">
                                        <option disabled {{ is_null($user->status) ? 'selected' : '' }}>افتح قائمة التحديد
                                        </option>
                                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>نشط
                                        </option>
                                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>غير
                                            نشط
                                        </option>
                                    </select>
                                </div>

                                {{-- Submit --}}
                                <div class="row row-xs wd-xl-80p">
                                    <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><button type="submit"
                                            class="btn btn-success btn-with-icon btn-block"><i class="typcn typcn-edit"></i>
                                            تأكيد
                                            البيانات</button>
                                    </div>

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
