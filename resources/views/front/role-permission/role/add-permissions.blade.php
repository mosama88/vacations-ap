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
        'urlPreviousPage' => 'dashboard.roles.index',
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
                                    <a href="#" class="btn btn-tool btn-link">#3</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="custom-control custom-checkbox">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'Permissions') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'Users') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'jobsGrades') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>



                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'leaves') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'governorates') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'branches') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'UserList') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'financeCalendars') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-3">
                                            @foreach ($permissions->where('category', 'Employees') as $permission)
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row row-xs wd-xl-80p">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><button type="submit"
                                    class="btn btn-success btn-with-icon btn-block"><i class="typcn typcn-edit"></i> تأكيد
                                    البيانات</button>
                            </div>
                        </div>
                    </div>
                </form>
    </section>

@endsection
