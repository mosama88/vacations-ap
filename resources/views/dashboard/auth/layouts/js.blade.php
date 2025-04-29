<!-- jQuery -->
<script src="{{ asset('dashboard') }}/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dashboard') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;
        submitButton.innerHTML = 'جاري تسجيل الدخول...'; // Optional: Change text while submitting
    });
</script>
