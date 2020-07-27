@extends('adminlte::page')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create user</h3>
    </div>

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
        <div class="form-group" style="width:450px;">
            <label for="name">Login</label>
            <input type="text" name="name" id="name" class="form-control">
            <label for="password">Password</label>
            <input type="text" name="password" id="password" class="form-control">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">
            <label for="role">Role</label>
            
            
            <select class="form-control" name="role">
              <option value="admin">Admin</option>
              <option value="manager">Manager</option>
            </select>
        </div>
            <div>
              <button type="submit" class="btn btn-success">Send</button>
            </div>
    </form>
</div>
@endsection
