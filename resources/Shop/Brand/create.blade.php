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
<form action="{{route('admin.brand.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    نام
    <br>
    <input type="text" name="name">
    <br>
    وضعیت
    <br>
    فعال
    <input type="radio" name="status" value="active">
    <br>
    غیر فعال
    <input type="radio" name="status" value="inactive">
    <br>
    عکس برند
    <br>
    <input type="file" name="file">
    <br>
    <button>save</button>
</form>
</body>
</html>
