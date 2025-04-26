<!DOCTYPE html>
<html>

<head>
    @include('dashboard.auth.layouts.css')
</head>

<body class="hold-transition login-page"
    style="
    background: url({{ asset('dashboard') }}/assets/dist/img/apa_building.jpeg) no-repeat center center fixed;
    background-size: cover;
    margin: 0;">
    <!-- Semi-transparent overlay -->
    <div
        style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Black with 50% opacity */
        z-index: -1;
    ">
    </div>

    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html" style="color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.5);">
                <b>برنامج الأجازات</b> هيئة النيابة الأدارية
            </a>
        </div>

        <div class="card" style="background-color: rgba(255, 255, 255, 0.9);"> <!-- 90% white opacity -->
            <div class="card-body login-card-body">
                <p class="login-box-msg">قم بتسجيل الدخول لبدء جلستك</p>

                @yield('content')

                <div class="social-auth-links text-center mb-3">
                    <p>- أو -</p>
                    <a href="#" class="btn btn-block btn-info">
                        <i class="fab fa-facebook mr-2"></i> التواصل مع وحدة التحول الرقمى
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.auth.layouts.js')
</body>

</html>
