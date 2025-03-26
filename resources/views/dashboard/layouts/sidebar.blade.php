<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dashboard') }}/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dashboard') }}/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                @auth('admin')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link @yield('active-dashboard')">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                الصفحة الرئيسية
                            </p>
                        </a>
                    </li>


                    <li
                        class="nav-item has-treeview {{ request()->is('dashboard/financeCalendars*') || request()->is('dashboard/branches*') || request()->is('dashboard/jobGrades*') ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ request()->is('financeCalendars*') || request()->is('branches*') || request()->is('jobGrades*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                الأعدادت
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.financeCalendars.index') }}"
                                    class="nav-link @yield('active-financeCalendars')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>السنوات المالية</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.branches.index') }}" class="nav-link @yield('active-branches')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>الفروع</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('dashboard.jobGrades.index') }}" class="nav-link @yield('active-jobGrades')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>الدرجات الوظيفية</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li
                        class="nav-item has-treeview {{ request()->is('dashboard/employees*') || request()->is('dashboard/leaveBalances*') ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ request()->is('employees*') || request()->is('employees*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                إدارة شئون الموظفين
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.employees.index') }}" class="nav-link @yield('active-employees')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>شئون الموظفين</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.leaveBalances.index') }}" class="nav-link @yield('active-leaveBalances')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>رصيد أجازات الموظف</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth

                @auth('employee')
                    <li class="nav-item has-treeview {{ request()->is('leaves*') ? 'menu-open' : '' }} ">
                        <a href="#" class="nav-link {{ request()->is('leaves*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                إدارة شئون الأجازات
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('leaves.create') }}" class="nav-link @yield('active-employees')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>طلب أجازه</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endauth

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
