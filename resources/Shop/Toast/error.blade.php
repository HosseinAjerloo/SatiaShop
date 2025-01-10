<div class="toast-container" id="toast-container">
</div>
@if($errors->any())
    @foreach($errors as $error)
        <script>
            showToast("{{$error}}");
            $(".progress-bar div").css({'background-color':'red'})
        </script>
    @endforeach
@endif
