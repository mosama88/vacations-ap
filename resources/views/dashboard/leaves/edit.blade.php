    <div class="modal fade" id="actionleave{{ $info->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">أخذ إجراء الأجازه</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('leaves.action.leave', $info->id) }}" method="POST">
                    @csrf
                    $leave->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleSelectBorder">نوع الأجازه</code></label>
                            <select name="leave_status"
                                class="custom-select form-control-border @error('leave_status') is-invalid @enderror"
                                id="exampleSelectBorder">
                                <option value="">-- أختر نوع الأجازه --</option>
                                <option @if (old('leave_status', $info->leave_status) == 1) selected @endif
                                    value="{{ App\Enum\LeaveStatusEnum::Approved }}">موافق</option>
                                <option @if (old('leave_status', $info->leave_status) == 2) selected @endif
                                    value="{{ App\Enum\LeaveStatusEnum::Pending }}">معلق</option>
                                <option @if (old('leave_status', $info->leave_status) == 3) selected @endif
                                    value="{{ App\Enum\LeaveStatusEnum::Refused }}">مرفوض</option>
                            </select>
                            @error('leave_status')
                                <span class="invalid-feedback text-right" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">تأكيد</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
