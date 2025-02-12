<script>

    @if(session('success-SweetAlert'))
    Swal.fire({
        title: 'عملیات با موفقیت انجام شد',
        text: "{{session('success-SweetAlert')}}",
        icon: 'success',
        confirmButtonText: 'بستن'
    });
    @endif
</script>
