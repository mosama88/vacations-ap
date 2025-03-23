<div class="modal fade" id="editIsOpen{{ $info->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">فتح الشهر المالى</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <p>هل تريد فتح الشهر المالى&hellip;</p>
                    <div class="form-group">
                        <label for="exampleSelectBorder">حالة الشهر المالى <code>لسنه</code></label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder">
                            <option value="{{ App\Enum\StatusOpen::Open }}">مفتوح</option>
                            <option value="{{ App\Enum\StatusOpen::Pending }}">معلق</option>
                            <option value="{{ App\Enum\StatusOpen::Archive }}">مؤرشف</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
