@php
    use App\Enum\EmployeeGender;
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dashboard') }}/assets/dist/img/administrativprosecution.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">هيئة النيابة الأدارية</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->gender == EmployeeGender::Male)
                    <img src="{{ asset('dashboard') }}/assets/dist/img/employees-default.png"
                        class="img-circle elevation-2" alt="User Image">
                @elseif (Auth::user()->gender == EmployeeGender::Female)
                    <img src="{{ asset('dashboard') }}/assets/dist/img/employees-female-default.png"
                        class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('dashboard') }}/assets/dist/img/avatar5.png" class="img-circle elevation-2"
                        alt="User Image">
                @endif

            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('dashboard.employee-panel.index') }}" class="nav-link @yield('active-employeePanel')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            الصفحة الرئيسية
                        </p>
                    </a>

                </li>
                @can('الأعدادت')
                    <li
                        class="nav-item has-treeview {{ request()->is('financeCalendars*') || request()->is('branches*') || request()->is('jobGrades*') || request()->is('jobTypes*') ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ request()->is('financeCalendars*') || request()->is('branches*') || request()->is('jobGrades*') || request()->is('jobTypes*') ? 'active' : '' }} ">
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

                            <li class="nav-item">
                                <a href="{{ route('dashboard.jobTypes.index') }}" class="nav-link @yield('active-jobTypes')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>نوع الوظيفه</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('إدارة شئون الموظفين')
                    <li
                        class="nav-item has-treeview {{ request()->is('employees*') || request()->is('leaveBalances*') ? 'menu-open' : '' }} ">
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
                @endcan
                @can('إدارة شئون الأجازات')
                    <li class="nav-item has-treeview {{ request()->is('leaves*') ? 'menu-open' : '' }}">

                        <a href="#" class="nav-link {{ request()->is('leaves*') ? 'active' : '' }} ">

                            <i class="nav-icon fab fa-creative-commons-share"></i>
                            <p>
                                إدارة شئون الأجازات
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                @can('كل موظفين النيابات الأجازات')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.leaves.index') }}" class="nav-link @yield('active-all')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> أجازات الموظفين كل النيابات</p>
                                    </a>
                                </li>
                            @endcan
                            @can('الموظفين الأجازات')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.leaves.leaveByBranch.index') }}"
                                        class="nav-link @yield('active-leaveByBranch')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> أجازات الموظفين</p>
                                    </a>
                                </li>
                            @endcan
                            @can('طلب الأجازات')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.leaves.create') }}" class="nav-link @yield('active-leaves-create')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>طلب أجازه</p>
                                    </a>
                                </li>
                            @endcan



                            @can('المعلقه الأجازات')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.leaves.getLeavespending') }}"
                                        class="nav-link @yield('active-pending')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> الأجازات المعلقه</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                @can('إدارة شئون المستخدمين')
                    <li
                        class="nav-item has-treeview {{ request()->is('users*') || request()->is('roles*') || request()->is('permissions*') ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ request()->is('users*') || request()->is('roles*') || request()->is('permission*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-key"></i>
                            <p>
                                إدارة شئون المستخدمين
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                @can('المستخدمين')
                                    <a href="{{ route('dashboard.employees.index') }}" class="nav-link @yield('active-users')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>جدول المستخدمين</p>
                                    </a>
                                @endcan
                                @can('الصلاحيات')
                                    <a href="{{ route('dashboard.roles.index') }}" class="nav-link @yield('active-roles')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>الصلاحيات</p>
                                    </a>
                                @endcan
                                @can('الأذونات')
                                    <a href="{{ route('dashboard.permission.index') }}" class="nav-link @yield('active-permission')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>الأذونات</p>
                                    </a>
                                @endcan

                            </li>

                        </ul>
                    </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
