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
<form action="{{route('admin.product.store')}}" method="POST">
    @csrf
    title
    <input type="text" placeholder="name" name="name" value="{{old('title')}}">
    <br>
    price
    <input type="text" placeholder="price" name="price" value="{{old('price')}}">
    <br>
    active
    <input type="radio" name="status" id="" value="active"
           @if(old('active')=='active') checked="checked" @endif >
    <br>
    inactive
    <input type="radio" name="status" id="" value="inactive"
           @if(old('active')=='inactive') checked="checked" @endif>
    <br>
    <select>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <br>
    file
    <input type="file" name="file">
    <button>send</button>
</form>
</body>
</html>
