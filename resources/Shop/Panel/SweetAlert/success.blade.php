<script>

    @if(session('success-SweetAlert'))
    document.addEventListener('DOMContentLoaded', function() {
        // Select button and add event listener
        Swal.fire({
            title: 'Hello World!',
            text: 'This is a SweetAlert2 example.',
            icon: 'success',
            confirmButtonText: 'Cool'
        });
    });
    @endif
</script>
