<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传素材</title>
</head>
<body>
<form action="/material/doup" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="material" >
    <input type="submit" value="上传">
</form>
</body>
</html>