@extends('dashboard.auth.layouts.master')
@section('title', 'صفحة تسجيل الدخول')
@section('content')
    <form action="{{ route('dashboard.login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control  @error('username') is-invalid @enderror"
                placeholder="أسم المستخدم">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('username')
                <span class="invalid-feedback text-right" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror"
                placeholder="مثال:***********">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback text-right" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-6">
                <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل الدخول</button>
            </div>
            <!-- /.col -->
            <div class="col-6 text-right">
                <div class="icheck-primary">
                    <label for="remember">
                        تذكرنى
                    </label>
                    <input type="checkbox" class="mx-1" id="remember">

                </div>
            </div>
            <!-- /.col -->

        </div>
    </form>
@endsection
