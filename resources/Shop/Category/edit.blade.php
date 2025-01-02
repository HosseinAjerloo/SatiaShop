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
<form action="{{route('menu.update',$menu->id)}}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" placeholder="name" name="name" value="{{old('name',$menu->name)}}">
    <br>
    <input type="number" placeholder="view_sort" name="view_sort" value="{{old('view_sort',$menu->view_sort)}}">
    <br>
    active
    <br>
    <input type="radio" name="status" id="" value="active" @if(old('active',$menu->status)=='active') checked="checked" @endif  >
    <br>
    inactive
    <input type="radio" name="status" id="" value="inactive" @if(old('active',$menu->status)=='inactive') checked="checked" @endif>
    <button>send</button>
</form>
</body>
</html>
