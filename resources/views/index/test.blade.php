<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/order')}}" method="post">
            订单id<input type="text" name="order_id">
            @csrf
            <button>提交</button>
    </form>
</body>
</html>