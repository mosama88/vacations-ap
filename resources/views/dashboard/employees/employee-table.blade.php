<div class="card-body p-0">
    <table class="table table-head-fixed text-nowrap">
        <thead>
            <tr>
                <th>#</th>
                <th>أسم الموظف</th>
                <th>أسم المستخدم</th>
                <th>الموبايل</th>
                <th>الراحه</th>
                <th>المحافظة</th>
                <th>أنشاء بواسطة</th>
                <th>تحديث بواسطة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $info)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->username }}</td>
                    <td>{{ $info->mobile }}</td>
                    <td>{{ $info->week->name }}</td>
                    <td>{{ $info->governorate->name }}</td>
                    <td>{{ $info->createdBy->username }}</td>
                    <td>
                        @if ($info->updated_by > 0)
                            {{ $info->UpdatedBy->username }}
                        @else
                            لا يوجد تحديث
                        @endif
                    </td>
                    <td class="project-actions">
                        @include('dashboard.partials.action', [
                            'name' => 'employees',
                            'name_id' => $info,
                        ])

                    </td>
                </tr>
            @empty
                <div class="alert alert-primary" role="alert">
                    عفوآ لاتوجد بيانات
                    !
                </div>
            @endforelse
        </tbody>
    </table>
    
    <div class="row mx-auto">
        <div class="col-12">
            {{ $data->links() }}
    
        </div>
    </div>
</div>
</div>
