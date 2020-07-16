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
                <input type="text" name="deal_name" class="form-control">
            </div>
            <div class="form-group">
                <label>open_date</label>
                <input type="dateTime-local" name="open_date" class="form-control pull-right" id="datepicker">
            </div>
            <div class="form-group">
                <label>close_date</label>
                <input type="dateTime-local" name="close_date" class="form-control">
            </div>
            <div class="form-group">
                <label>deal_descrip</label>
                <input type="text" name="deal_descrip" class="form-control">
            </div>
            <div class="form-group">
                <label>deadline</label>
                <input type="dateTime-local" name="deadline" class="form-control">
            </div>
            <div class="form-group">
                <label>user_id</label>
                
            </div>
            <div class="form-group">
                <label>status</label>
                <input type="text" name="status" class="form-control">
            </div>
            
        </div>
                <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    
</div>

@endsection