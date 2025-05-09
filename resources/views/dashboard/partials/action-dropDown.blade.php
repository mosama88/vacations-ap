<li>
    <a class="dropdown-item text-primary" href="{{ route('dashboard.' . $name . '.show', $name_id) }}">
        <i class="mx-1 fas fa-folder">
        </i> عرض
</li>
<li>
    <a class="dropdown-item text-info" href="{{ route('dashboard.' . $name . '.edit', $name_id) }}">
        <i class="mx-1 fas fa-pencil-alt">
        </i> تعديل
</li>
<li>
    <form id="delete-form-{{ $name_id }}" action="{{ route('dashboard.' . $name . '.destroy', $name_id) }}"
        method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <button id="delete_one" data-id="{{ $name_id }}" class="dropdown-item text-danger delete-btn">
        <i class="fas fa-trash-alt mx-1"></i>
        حذف
    </button>
</li>


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach event listener to delete buttons
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default behavior

                    // Retrieve the form ID from the button's data attribute
                    const nameId = this.getAttribute('data-id');
                    const form = document.getElementById(`delete-form-${nameId}`);

                    // Display SweetAlert confirmation dialog
                    Swal.fire({
                        title: "هل أنت متأكد ؟",
                        text: "أنت على وشك حذف العناصر المحددة!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: "إحذف",
                        cancelButtonText: "إلغاء",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform AJAX request
                            fetch(form.action, {
                                    method: 'POST',
                                    body: new FormData(form),
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}" // Add CSRF token
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: "تم الحذف",
                                            text: data
                                                .message, // هذه الرسالة تأتي من الـ Controller
                                            icon: 'success',
                                            timer: 1500,
                                            showConfirmButton: false
                                        }).then(() => {
                                            location
                                                .reload(); // Reload the page
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "خطأ!",
                                            text: data.message ||
                                                "حدث خطأ غير متوقع",
                                            icon: 'error'
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: "خطأ!",
                                        text: "حدث خطأ غير متوقع",
                                        icon: 'error'
                                    });
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
