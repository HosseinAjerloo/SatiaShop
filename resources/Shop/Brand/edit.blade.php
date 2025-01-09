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
<form action="{{route('admin.brand.update',$brand->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    نام
    <br>
    <input type="text" name="name" value="{{old('name',$brand->name)}}">
    <br>
    وضعیت
    <br>
    فعال
    <input type="radio" name="status" value="active" @if(old('status',$brand->status)=='active') checked="checked" @endif >
    <br>
    غیر فعال
    <input type="radio" name="status" value="inactive"  @if(old('status',$brand->status)=='inactive') checked="checked" @endif>
    <br>
    عکس برند
    <br>
    <input type="file" name="file">
    <br>
    <button>save</button>
</form>
</body>
</html>
