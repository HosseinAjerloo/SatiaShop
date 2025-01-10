<div class="toast-container" id="toast-container">
</div>
@if(session('success'))
        <script>
            showToast("{{session('success')}}");
        </script>
@endif
