@php
    use App\Enum\LeaveBalanceStatus;
@endphp

<div>
    <div>
        <div class="form-group col-6">
            <label for="exampleSelectBorder">بحث بالأسم أو الكود او أسم المستخدم </label>
            <input type="text" wire:model.live="emp_search" value="" class="form-control" id="exampleInputusername"
                placeholder="أدخل أسم الموظف">
            </select>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-head-fixed text-nowrap table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>كود الموظف</th>
                    <th>أسم الموظف</th>
                    <th>السنه</th>
                    <th>رصيد</th>
                    <th>الرصيد المستخدم</th>
                    <th>الرصيد المتبقى</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $info)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $info->employee->employee_code }}</td>
                        <td>{{ $info->employee->name }}</td>
                        <td>{{ $info->financeCalendar?->finance_yr }}</td>
                        <td>{{ $info->total_days }}</td>
                        <td>{{ $info->used_days }}</td>
                        <td>{{ $info->remainig_days }}</td>
                        <td>
                            @if ($info->status == LeaveBalanceStatus::Open)
                                <span class="badge bg-success">مفعل</span>
                            @else
                                <span class="badge bg-danger">مؤرشف</span>
                            @endif
                        </td>

                        <td class="project-actions">
                            @include('dashboard.partials.action', [
                                'name' => 'leaveBalances',
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
        {{ $data->links() }}
    </div>
</div>
