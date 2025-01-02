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
<form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" placeholder="name" name="name" value="{{old('name')}}">
    <br>
    <input type="number" placeholder="view_sort" name="view_sort" value="{{old('view_sort')}}">
    <br>
    active
    <br>
    <input type="radio" name="status" id="" value="active" @if(old('active')=='active') checked="checked" @endif  >
    <br>
    inactive
    <input type="radio" name="status" id="" value="inactive" @if(old('active')=='inactive') checked="checked" @endif>
    <br>
    <select name="menu_id">
        @foreach($menus as $menu)
        <option value="{{$menu->id}}">{{$menu->name}}</option>
        @endforeach
    </select>
    <input type="file" name="file">
    <button>send</button>
</form>
</body>
</html>
