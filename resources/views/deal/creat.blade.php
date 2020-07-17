@extends('adminlte::page')

@section('content')


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Quick Example</h3>
    </div>

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
    @endif
    <!-- /.box-header -->
    <!-- form start -->

    <form role="form" method="POST" action="{{route('deals.store')}}">
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label>deal_name</label>
                <input type="text" name="deal_name" class="form-control" value="{{old('deal_name')}}">
            </div>


            <div class="form-group">
                <label>close_date</label>
                <input type="dateTime-local" name="close_date" class="form-control" value="{{old('close_date')}}">
            </div>
            <div class="form-group">
                <label>deal_descrip</label>
                <input type="text" name="deal_descrip" class="form-control" value="{{old('deal_descrip')}}">
            </div>
            <div class="form-group">
                <label>deadline</label>
                <input type="dateTime-local" name="deadline" class="form-control" value="{{old('deadline')}}">
            </div>
            <div class="form-group">
                <label>Cient</label>
                    @foreach($clients as $client)
                        <input type="checkbox" name="clients[]" value="{{$client->id}}">
                        <label class="">{{$client->second_name}}</label>
                    @endforeach
            </div>
            <div class="form-group">
                <label for="post-title">comment</label>
                <input type="text" name="comment" class="form-control" value="{{old('comment')}}">
            </div>
            <div class="form-group">
                <label for="post-title">status</label>
                <select name="status" class="form-control" value="{{old('status')}}">
                    <option >open</option>
                    <option >closed</option>
                </select>
            </div>

        </div>
                <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>

@endsection
