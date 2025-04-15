@extends('dashboard.layouts.master')
@section('active-roles', 'active')
@section('title', 'تعديل منح الأذونات')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')
    @include('dashboard.layouts.message')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل منح الأذونات',
        'previousPage' => 'جدول الأذونات',
        'urlPreviousPage' => 'roles.index',
        'currentPage' => 'تعديل منح الأذونات',
    ])


    <section class="content pb-3">
        <div class="container-fluid h-100">
            <div class="card card-row card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        منح الأذونات
                    </h3>
                </div>
                <form action="{{ url('roles/' . $role->id . '/give-permissions') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h5 class="card-title">{{ $role->name }}</h5>
                        <div class="card-tools">
                            <!-- Permissions Select All Checkbox -->
                            <input class="mx-1" type="checkbox" id="selectAllPermissions"
                                onclick="toggleSelectAll('permissions')" />تحديد الكل
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mg-b-0 text-md-nowrap table-hover">
                            <tr>
                                <td class="wd-500">الصلاحيات</td>
                                <td>
                                    @foreach ($permissions->where('category', 'roles') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500">الأذونات</td>
                                <td>
                                    @foreach ($permissions->where('category', 'Permissions') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500"> Users</td>
                                <td>
                                    @foreach ($permissions->where('category', 'Users') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500"> السنوات المالية</td>
                                <td>
                                    @foreach ($permissions->where('category', 'financeCalendars') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500"> الدرجات الوظيفية</td>
                                <td>
                                    @foreach ($permissions->where('category', 'jobsGrades') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500"> الأجازات</td>
                                <td>
                                    @foreach ($permissions->where('category', 'leaves') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>

                            <tr>
                                <td class="wd-500"> المحافظات</td>
                                <td>
                                    @foreach ($permissions->where('category', 'governorates') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500"> الفروع</td>
                                <td>
                                    @foreach ($permissions->where('category', 'branches') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500"> الأعدادت</td>
                                <td>
                                    @foreach ($permissions->where('category', 'settings') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500"> الموظفين</td>
                                <td>
                                    @foreach ($permissions->where('category', 'Employees') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="wd-500"> رصيد الموظف</td>
                                <td>
                                    @foreach ($permissions->where('category', 'leaveBalances') as $permission)
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="permissionsCheckbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        </table>

                        <div class="card-footer text-center ">
                            <button type="submit" class="btn btn-primary">تعديل الصلاحية <i class="fas fa-save mx-1"></i>
                            </button>
                        </div>
                    </div>
            </div>
        </div>

        </form>
    </section>

@endsection
@push('js')
    <script>
        // Function to toggle "Select All" checkboxes in each category
        function toggleSelectAll(category) {
            let checkboxes = document.querySelectorAll('.' + category + 'Checkbox');
            let isChecked = document.getElementById('selectAll' + capitalizeFirstLetter(category)).checked;

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        }

        // Capitalize the first letter for 'selectAll' ID
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
@endpush
