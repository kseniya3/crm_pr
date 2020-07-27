@extends('adminlte::page')

@section('content')


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit user</h3>
    </div>

    <form action="{{route('users.update_user',$data->id)}}" method="post">
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
        <div class="form-group" style="width:450px;">
            <label for="name" >Login</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$data->name}}">
            <label for="password" >Password</label>
            <input type="text" name="password" id="password" class="form-control" >
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{$data->email}}">
            <label for="role">Role</label>
            <input type="text" name="role" id="role" class="form-control" value="{{$data->role}}">
            
        </div>
        <div>
            <button type="submit" class="btn btn-success">отправить</button>
        </div>
    </form>
@endsection