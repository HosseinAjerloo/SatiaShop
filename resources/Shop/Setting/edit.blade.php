<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{--@if($errors->any())--}}
{{--    @dd($errors->all());--}}
{{--@endif--}}
<form action="{{route('setting.update',$setting->id)}}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <input type="text" placeholder="name" name="name" value="{{old('name',$setting->name)}}">
    <br>
    file
    <input type="file" name="file">
    <button>send</button>
</form>
</body>
</html>
