<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обновление</title>
</head>
<body>
   {{--  @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif --}}
    <form action="{{route('clients.update_client',$data->id)}}" method="post">
        @csrf
        <div class="form-group">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
            <label for="second_name">second name</label>
            <input type="text" name="second_name" id="second_name" class="form-control" value="{{$data->second_name}}">
            <label for="first_name">first name</label>
            <input type="text" name="first_name" id="first_name"class="form-control" value="{{$data->first_name}}">
            <label for="middle_name">middle name</label>
            <input type="text" name="middle_name" id="middle_name"class="form-control" value="{{$data->middle_name}}">
            <label for="contacts_telephone">contact phone</label>
            <input type="text" name="contacts_telephone" id="contacts_telephone"class="form-control" value="{{$data->contacts_telephone}}">
            <label for="contacts_email">contact_email</label>
            <input type="text" name="contacts_email" id="contacts_email"class="form-control" value="{{$data->contacts_email}}">
            <label for="description">description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" >{{$data->description}}</textarea>
            <label for="company_name">company name</label>
            <input type="text" name="company_name" id="company_name"class="form-control" value="{{$data->company_name}}">
            <button type="submit" class="btn btn-success">обновить</button>
            <div class="form-group">
              <label>Deal</label>
                  @foreach($deals as $deal)
                      <input type="checkbox" name="deals[]" value="{{$deal->id}}">
                      <label class="">{{$deal->deal_name}}</label>
                  @endforeach
            </div>
        </div>
    </form>
</body>
</html>