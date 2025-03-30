<div class="modal fade" id="delete{{ $role->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">إحذر: ستقوم بحذف العملية !</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <h5>{{ $role->name }}</h5>

                        <div class="form-group">
                            <input type="hidden" name="page_id" value="1" class="form-control"
                                id="recipient-name">

                            <input type="hidden" name="id" value="{{ $role->id }}">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-danger">تأكيد البيانات</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
