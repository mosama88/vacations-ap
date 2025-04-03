<div class="modal fade" id="editLeaveModal{{ $info->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.leaves.update', $info->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="leave_status">نوع الإجازة</label>
                        <select name="leave_status" class="form-control" id="leave_status">
                            <option value="">-- أختر نوع الأجازه --</option>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
