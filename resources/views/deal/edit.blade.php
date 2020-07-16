@extends('adminlte::page')

@section('content')
<div class="row">
<div class="col-lg-6 mx-auto">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{route('deals.update', $deal->id)}}">
     @csrf
     @method('PATCH')

        <div class="form-group">
            <label for="post-title">Manager:{{$user->name}}</label>
        </div>

        <div class="form-group">
            <label for="post-title">deal_name</label>
            <input type="text" name="deal_name"
                   value="{{$deal->deal_name}}" class="form-control" id="post-title">
        </div>
        <div class="form-group">
            <label for="post-title">open_date</label>
            <input type="text" name="open_date"
                   value="{{$deal->open_date}}" class="form-control" id="post-title">
        </div>
        <div class="form-group">
            <label for="post-title">close_date</label>
            <input type="text" name="close_date"
                   value="{{$deal->close_date}}" class="form-control" id="post-title">
        </div>
        <div class="form-group">
            <label for="post-title">deal_descrip</label>
            <input type="text" name="deal_descrip"
                   value="{{$deal->deal_descrip}}" class="form-control" id="post-title">
        </div>
        <div class="form-group">
            <label for="post-title">deadline</label>
            <input type="text" name="deadline"
                   value="{{$deal->deadline}}" class="form-control" id="post-title">
        </div>
        <div class="form-group">
            <label for="post-title">status</label>
            <input type="text" name="status"
                   value="{{$deal->status}}" class="form-control" id="post-title">
        </div>
        <button type="submit" class="btn btn-success">Отредактировать</button>
    </form>
</div>
</div>
@endsection
