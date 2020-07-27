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

        {{-- <div class="form-group">
            <label for="post-title">close_date</label>
            <input type="text" name="close_date"
                   value="{{$deal->close_date}}" class="form-control" id="post-title">
        </div> --}}
        <div class="form-group">
            <label for="post-title">deal_descrip</label>
            <input type="text" name="deal_descrip"
                   value="{{$deal->deal_descrip}}" class="form-control" id="post-title">
        </div>
        <div class="form-group">
            <label for="post-title">deadline</label>
            <input type="text" name="deadline"
                   value="{{$deal->deadline}}" class="form-control" style="width:500px" id="post-title">
        </div>
        <div class="form-group">
            <label>Cient</label>
            @foreach($clients as $client)
                <input type="checkbox" name="clients[]" value="{{$client->id}}"
                       @if($deal->clients->where('id', $client->id)->count())
                       checked="checked"
                    @endif
                >
                <label class="">{{$client->second_name}}</label>
            @endforeach
        </div>
        <div class="form-group">
            <label for="post-title">status</label>
            <select name="status" class="form-control">
                    <option >open</option>
                    <option >closed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Edit</button>
    </form>
</div>
</div>
@endsection
