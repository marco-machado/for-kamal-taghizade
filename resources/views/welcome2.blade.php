<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
</head>
<body>
<form action="/api/items" method="post">
    @csrf
    <input type="text" name="name" id="name">
    <input type="text" name="description" id="description">
    <input type="file" name="file" id="file">
    <input type="number" name="type" id="type">
    <input type="submit" value="Submit">
</form>
</body>
</html>
