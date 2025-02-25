
@if(session('success'))
        <script>
            showToast("{{session('success')}}");
        </script>
@endif
