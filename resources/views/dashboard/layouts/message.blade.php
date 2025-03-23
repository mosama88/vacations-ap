@push('js')
    <script>
        $(document).ready(function() {
            @if ($errors->has('error'))
                toastr.error('{{ $errors->first('error') }}');
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                var Dynamic = '{{ session('success') }}';
                toastr.success(Dynamic);
            @endif
        });
    </script>
@endpush
