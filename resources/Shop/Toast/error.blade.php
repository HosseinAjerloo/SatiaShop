@if($errors->any())
    @foreach($errors->all() as $error)
        <script>
            showToast("{{$error}}");
            $(".progress-bar div").css({'background-color':'red'})
        </script>
    @endforeach
@endif
