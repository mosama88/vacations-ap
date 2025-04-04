<div class="modal fade" id="show{{ $info->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">تفاصيل الاجازه</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-4" id="employee_div">
                        <label for="exampleInputName">كود الموظف</label>
                        <input disabled type="text" id="employee_code" value="{{ $employees->employee_code }}"
                            name="employee_code" class="form-control" id="exampleInputemployee_id" placeholder="">
                    </div>
                    <div class="form-group col-4" id="employee_div">
                        <label for="exampleInputName">أسم الموظف</label>
                        <input disabled type="text" id="employee_id" value="{{ $employees->name }}"
                            name="employee_id" class="form-control" id="exampleInputemployee_id" placeholder="">
                    </div>
                    <div class="form-group col-4">
                        <label for="exampleSelectBorder">الراحه الاسبوعية</code></label>
                        <input disabled type="text" id="week_id" value="{{ $employees->week->name }}"
                            name="week_id" class="form-control" id="exampleInputweek_id" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="exampleInputName">رصيد الأجازات
                            <span class="text-info">(الأعتيادى)</span> </label>
                        <input disabled type="text" name="total_days"
                            value="{{ $employees->leaveBalance->total_days ?? 'لا يوجد رصيد' }}" class="form-control"
                            id="exampleInputtotal_days" placeholder="">
                    </div>


                    <div class="form-group col-4">
                        <label for="exampleInputName">الرصيد المستخدم <span class="text-info">(الأعتيادى)</span>
                        </label>
                        <input disabled type="text" name="used_days"
                            value="{{ $employees->leaveBalance->used_days ?? 'لا يوجد رصيد' }}" name="used_days"
                            class="form-control" id="exampleInputused_days" placeholder="">
                    </div>

                    <div class="form-group col-4">
                        <label for="exampleInputName">الرصيد المتبقى <span class="text-info">(الأعتيادى)</span>
                        </label>
                        <input disabled type="text"
                            value="{{ $employees->leaveBalance->remainig_days ?? 'لا يوجد رصيد' }}" name="remainig_days"
                            class="form-control" id="exampleInputremainig_days" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="exampleInputName"> رصيد
                            الأجازات <span class="text-danger">(العارضه)</span> </label>
                        <input disabled type="text" name="total_days_emergency"
                            value="{{ $employees->leaveBalance->total_days_emergency ?? 'لا يوجد رصيد' }}"
                            class="form-control" id="exampleInputtotal_days_emergency" placeholder="">
                    </div>


                    <div class="form-group col-4">
                        <label for="exampleInputName">الرصيد المستخدم <span class="text-danger">(العارضه)</span>
                        </label>
                        <input disabled type="text" name="used_days_emergency"
                            value="{{ $employees->leaveBalance->used_days_emergency ?? 'لا يوجد رصيد' }}"
                            name="used_days_emergency" class="form-control" id="exampleInputused_days_emergency"
                            placeholder="">
                    </div>

                    <div class="form-group col-4">
                        <label for="exampleInputName">الرصيد المتبقى <span class="text-danger">(العارضه)</span>
                        </label>
                        <input disabled type="text"
                            value="{{ $employees->leaveBalance->remainig_days_emergency ?? 'لا يوجد رصيد' }}"
                            name="remainig_days_emergency" class="form-control" id="exampleInputremainig_days_emergency"
                            placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label>بداية الأجازه</label>
                        <input disabled type="date" name="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date', $info->start_date) }}" placeholder="أدخل السنه المالية">
                        @error('start_date')
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>نهاية الأجازه</label>
                        <input disabled type="date" name="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date', $info->end_date) }}" placeholder="أدخل السنه المالية">
                        @error('end_date')
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="exampleSelectBorder">نوع الأجازه</code></label>
                        <select disabled name="leave_type"
                            class="custom-select form-control-border @error('leave_type') is-invalid @enderror"
                            id="exampleSelectBorder">
                            <option value="">-- أختر نوع الأجازه --</option>
                            <option @if (old('leave_type', $info->leave_type) == App\Enum\LeaveTypeEnum::Emergency) selected @endif
                                value="{{ App\Enum\LeaveTypeEnum::Emergency }}">عارضه</option>
                            <option @if (old('leave_type', $info->leave_type) == App\Enum\LeaveTypeEnum::Regular) selected @endif
                                value="{{ App\Enum\LeaveTypeEnum::Regular }}">إعتيادى</option>
                            <option @if (old('leave_type', $info->leave_type) == App\Enum\LeaveTypeEnum::Annual) selected @endif
                                value="{{ App\Enum\LeaveTypeEnum::Annual }}">سنوى</option>
                            <option @if (old('leave_type', $info->leave_type) == App\Enum\LeaveTypeEnum::Sick) selected @endif
                                value="{{ App\Enum\LeaveTypeEnum::Sick }}">مرضى</option>
                        </select>
                        @error('leave_type')
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="exampleSelectBorder">سبب الأجازه</code></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3"
                            placeholder="أدخل السبب ...">{{ old('description', $info->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <form action="{{ route('dashboard.leaves.update', $info->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="leave_status">حالة الإجازة</label>
                                <select name="leave_status" class="form-control" id="leave_status">
                                    <option value="">-- أختر حالة الأجازه --</option>
                                    <option @if (old('leave_status', $info->leave_status) == App\Enum\LeaveStatusEnum::Approved) selected @endif
                                        value="{{ App\Enum\LeaveStatusEnum::Approved }}">
                                        موافق</option>
                                    <option @if (old('leave_status', $info->leave_status) == App\Enum\LeaveStatusEnum::Pending) selected @endif
                                        value="{{ App\Enum\LeaveStatusEnum::Pending }}">
                                        معلق</option>
                                    <option @if (old('leave_status', $info->leave_status) == App\Enum\LeaveStatusEnum::Refused) selected @endif
                                        value="{{ App\Enum\LeaveStatusEnum::Refused }}">
                                        مرفوض</option>
                                </select>
                                @error('leave_status')
                                    <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                </div>
            </div>

     
        <!-- /.card-body -->

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
        </div>

        </form>
    </div>
    <!-- /.modal-content -->
</div>
