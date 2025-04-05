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




                    <div class="card-body">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Permissions</h5>
                                <div class="card-tools">
                                    <!-- Permissions Select All Checkbox -->
                                    <input class="mx-1" type="checkbox" id="selectAllPermissions"
                                        onclick="toggleSelectAll('permissions')" />تحديد الكل
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="custom-control custom-checkbox">
                                    <div class="row mb-3">
                                        <!-- Permissions Category -->
                                        <div class="col-4">
                                            @foreach ($permissions->where('category', 'Permissions') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Users Category -->
                                        <div class="col-4">
                                            @foreach ($permissions->where('category', 'Users') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- jobsGrades Category -->
                                        <div class="col-4">
                                            @foreach ($permissions->where('category', 'jobsGrades') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- leaves Category -->
                                        <div class="col-4">
                                            @foreach ($permissions->where('category', 'leaves') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Additional Categories -->
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            @foreach ($permissions->where('category', 'governorates') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-4">
                                            @foreach ($permissions->where('category', 'branches') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-4">
                                            @foreach ($permissions->where('category', 'UserList') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach

                                            @foreach ($permissions->where('category', 'settings') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    <!-- Finance Calendars -->
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            @foreach ($permissions->where('category', 'financeCalendars') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="permissionsCheckbox"
                                                            name="permission[]" value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                

                                    </div>
                                            <div class="row mb-3">
                                            <div class="col-4">
                                                @foreach ($permissions->where('category', 'leaveBalances') as $permission)
                                                    <div class="col-md-12">
                                                        <label>
                                                            <input type="checkbox" class="permissionsCheckbox"
                                                                name="permission[]" value="{{ $permission->name }}"
                                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="col-4">
                                                @foreach ($permissions->where('category', 'Employees') as $permission)
                                                    <div class="col-md-12">
                                                        <label>
                                                            <input type="checkbox" class="permissionsCheckbox"
                                                                name="permission[]" value="{{ $permission->name }}"
                                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="row row-xs wd-xl-80p">
                                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                                    <button type="submit" class="btn btn-success btn-with-icon btn-block"><i
                                            class="typcn typcn-edit"></i> تأكيد البيانات</button>
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
