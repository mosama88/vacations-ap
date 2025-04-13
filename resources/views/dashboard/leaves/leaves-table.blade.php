@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
    use App\Enum\EmployeeStatus;
@endphp

<div class="card-body p-0">
    <div class="row col-12 my-2">
        <div class="form-group col-6">
            <label for="exampleInputName">بحث باسم الموظف أو أسم المستخدم أو كود المستخدم</label>
            <input type="text" wire:model.live="emp_search" class="form-control" id="exampleInputName"
                placeholder="أدخل موظف جديد">
        </div>

        <div class="form-group col-6">
            <label for="exampleSelectBorder">نوع الأجازه</code></label>
            <select wire:model.live="leave_type_search" class="custom-select form-control-border"
                id="exampleSelectBorder">
                <option value="">-- أختر نوع الأجازه --</option>
                <option @if (old('leave_type') == 1) selected @endif value="{{ LeaveTypeEnum::Emergency }}">
                    عارضه</option>
                <option value="{{ LeaveTypeEnum::Regular }}">
                    إعتيادى</option>
                <option value="{{ LeaveTypeEnum::Annual }}">
                    سنوى
                </option>
                <option value="{{ LeaveTypeEnum::Sick }}">مرضى
                </option>
            </select>
        </div>


        <div class="form-group col-6">
            <label class="visually-hidden" for="specificSizeInputGroupUsername">بداية
                الأجازة</label>
            <div class="input-group">
                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                <input type="text" id="start_date" wire:model.live="start_date_search" class="form-control bg-white"
                    value="" placeholder="اختر تاريخ البداية">
            </div>

        </div>

        <div class="form-group col-6">
            <label class="visually-hidden" for="specificSizeInputGroupUsername">نهاية
                الأجازة</label>
            <div class="input-group">
                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                <input type="text" id="end_date" wire:model.live="end_date_search" class="form-control bg-white"
                    value="" placeholder="اختر تاريخ النهاية">
            </div>
        </div>

        <div class="form-group col-6">
            <label for="leave_status">حالة الإجازة</label>
            <select wire:model.live="leave_status_search" class="custom-select form-control-border"
                id="exampleSelectBorder">
                <option value="">-- أختر حالة الأجازه --</option>
                <option value="{{ LeaveStatusEnum::Pending }}">
                    معلق</option>
                <option value="{{ LeaveStatusEnum::Approved }}">
                    موافق</option>
                <option value="{{ LeaveStatusEnum::Refused }}">
                    مرفوض
                </option>
            </select>
        </div>

        <div class="form-group col-3">
            <label></label>
            <div class="mg-t-10">
                @if (empty($emp_search) &&
                        empty($start_date_search) &&
                        empty($end_date_search) &&
                        empty($leave_type_search) &&
                        empty($leave_status_search))
                    <div class="mg-t-10">
                        <button class="btn  btn-light btn-block" disabled>أمسح</button>
                    </div>
                @else
                    <div class="mg-t-10">
                        <button wire:click.prevent="clear()" class="btn btn-primary btn-block">أمسح</button>
                    </div>
                @endif

            </div>

        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>كود الأجازه</th>
                    <th>مقدم الأجازه</th>
                    <th>نوع الأجازه</th>
                    <th>بداية الاجازه</th>
                    <th>نهاية الاجازه</th>
                    <th>عدد الأيام</th>
                    <th>حالة الاجازه</th>
                    <th>ملاحظات</th>
                    <th>انشاء بواسطة</th>
                    <th>تحديث بواسطة</th>
                    <th>عرض الرصيد</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $info)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $info->leave_code }}</td>
                        <td>{{ $info->employee->name }}</td>
                        <td>
                            @if ($info->leave_type == LeaveTypeEnum::Emergency)
                                عارضه
                            @elseif ($info->leave_type == LeaveTypeEnum::Regular)
                                إعتيادى
                            @elseif ($info->leave_type == LeaveTypeEnum::Annual)
                                سنوى
                            @else
                                مرضى
                            @endif
                        </td>
                        <td>{{ $info->start_date }}</td>
                        <td>{{ $info->end_date }}</td>
                        <td>{{ $info->days_taken * 1 }}</td>
                        <td>
                            @if ($info->leave_status == LeaveStatusEnum::Approved)
                                <span class="badge bg-primary">موافق</span>
                            @elseif ($info->leave_status == LeaveStatusEnum::Pending)
                                <span class="badge bg-warning">معلقه</span>
                            @else
                                <span class="badge bg-danger">مرفوض</span>
                            @endif

                        </td>
                        <td>{{ $info->description }}</td>
                        <td>{{ $info->created_by ? $info->createdBy->name : 'لا يوجد' }}</td>
                        <td>{{ $info->updated_by ? $info->updatedBy->name : 'لا يوجد تحديث' }}</td>
                        <td>
                            <a class="btn btn-outline-info btn-sm mx-2"
                                href="{{ route('dashboard.leaves.edit', $info->id) }}"><i
                                    class="fas fa-edit ml-1"></i></a>

                            <a class="btn btn-outline-success btn-sm mx-2"
                                href="{{ route('dashboard.leaves.show', $info->id) }}"><i
                                    class="fas fa-eye ml-1"></i></a>
                        </td>
                    @empty
                        لا توجد أجازات
                @endforelse
                </tr>
            </tbody>
        </table>

        <div class="col-md-12">
            {{ $data->links() }}

        </div>
    </div>
</div>
</div>
