<!DOCTYPE html>
<html>

<head>
    @include('dashboard.auth.layouts.css')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>برنامج الأجازات</b> هيئة النيابة الأدارية</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">قم بتسجيل الدخول لبدء جلستك</p>

                @yield('content')

                <div class="social-auth-links text-center mb-3">
                    <p>- أو -</p>
                    <a href="#" class="btn btn-block btn-info">
                        <i class="fab fa-facebook mr-2"></i> التواصل مع وحدة التحول الرقمى
                    </a>
                </div>
                <!-- /.social-auth-links -->


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    @include('dashboard.auth.layouts.js')

</body>

</html>
