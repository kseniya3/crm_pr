<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление пользователей</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <form action="{{route('users.create_user')}}" method="post">
        @csrf
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
        <div class="form-group">
            <label for="name">login</label>
            <input type="text" name="name" id="name" class="form-control">
            <label for="password">password</label>
            <input type="text" name="password" id="password" class="form-control">
            <label for="email">email</label>
            <input type="text" name="email" id="email" class="form-control">
            <label for="role">role</label>
            <input type="text" name="role" id="role" class="form-control">
            
            <button type="submit" class="btn btn-success">отправить</button>
        </div>
    </form>
</body>
</html>