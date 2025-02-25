<script>

    @if(session('error-SweetAlert'))
    Swal.fire({
        title: 'خطا در انجام عملیات',
        text: "{{session('error-SweetAlert')}}",
        icon: 'error',
        confirmButtonText: 'بستن'
    });
    @endif
</script>
