@php

    use App\Enum\LeaveBalanceStatus;

@endphp
<div>
    <div>
        <div class="form-group col-6">
            <label for="exampleSelectBorder">أسم الموظف </label>
            <select wire:model.live="emp_search" class="form-control select2 vh-100 @error('employee_id') is-invalid @enderror"
                id="exampleSelectBorder">
                <option value="">-- أختر الموظف --</option>
                @forelse ($other['employees'] as $employee)
                    <option @if (old('employee_id') == $employee->id) selected @endif value="{{ $employee->id }}">
                        {{ $employee->name }}</option>
                @empty
                    عفوآ لا توجد بيانات!
                @endforelse
            </select>
            @error('employee_id')
                <span class="invalid-feedback text-right" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-head-fixed text-nowrap">
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
                        <td>{{ $info->financeCalendar->finance_yr }}</td>
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
