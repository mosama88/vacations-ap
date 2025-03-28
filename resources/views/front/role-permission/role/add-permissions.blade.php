@extends('dashboard.layouts.master')
@section('title', 'أضافة أذونات`')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{URL::asset('dashboard/assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{URL::asset('dashboard/assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الأذونات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضافة أذونات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>الصلاحية : {{ $role->name }}
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 col-12">
                                @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label for="">الأذونات</label>

                                <div class="row">
                                    <ul id="treeview1" class="col-12">

                                        <li>
                                            <a href="#">Roles</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Roles') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">Permissions</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Permissions') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">Users</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Users') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">الأعدادات العامه</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'General Settings') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">العطلات الرسمية</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Holidays') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">الدرجات الوظيفية</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Job Grades') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">المسمى الوظيفي</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Job Titles') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">النيابات الأدارات</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Departments') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#">الموظفين</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Employees') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">الأجازات</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Vacations Management') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#">أضافة وحذف وتعديل</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'General') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#">المرفقات</a>
                                            <ul>

                                                <ul>
                                                    <li>
                                                        @foreach ($permissions->where('category', 'Attachments') as $permission)
                                                            <div class="col-md-12">
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="permission[]"
                                                                        value="{{ $permission->name }}"
                                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    />
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>

                                            </ul>
                                        </li>


                                        <li>
                                            <a href="#">User List</a>
                                            <ul>

                                                    <ul>
                                                        <li>
                                                            @foreach ($permissions->where('category', 'User List') as $permission)
                                                                <div class="col-md-12">
                                                                    <label>
                                                                        <input
                                                                            type="checkbox"
                                                                            name="permission[]"
                                                                            value="{{ $permission->name }}"
                                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                        />
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </li>
                                                    </ul>

                                    </ul>
                                        </li>




                                    </ul>
                                </div>

                            </div>

                            {{-- Submit --}}
                            <div class="row row-xs wd-xl-80p">
                                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><button type="submit"
                                                                                         class="btn btn-success btn-with-icon btn-block"><i class="typcn typcn-edit"></i> تأكيد
                                        البيانات</button>
                                </div>
                                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><a
                                        href="{{ url('roles') }}" type="submit"
                                        class="btn btn-info btn-with-icon btn-block"><i
                                            class="typcn typcn-arrow-back-outline"></i> رجوع</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>


@endsection

@section('js')

    <script src="{{URL::asset('dashboard/assets/plugins/treeview/treeview.js')}}"></script>
@endsection
