<!DOCTYPE html>
<html>
<head>
  <title>test</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="{{asset ('css/wp.css')}}" >
</head>

<body>
    <form method='post' action="{{url("test_action")}}">
       {{csrf_field()}}
       <input type="datetime-local" name="test">
       <input type="datetime-local" name="test1">
       <input type="submit" value="submit">
    </form>
</body>