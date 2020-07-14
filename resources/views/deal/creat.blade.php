@extends('adminlte::page')

@section('content')
@if($item->exists)
    <form method="POST" action="{{route('deals.create') }}"></form>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Quick Example</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

    <form role="form">
        <div class="box-body">
            <div class="form-group">
                <label>deal_name</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>open_date</label>
                <input type="text" class="form-control pull-right" id="datepicker">
            </div>
            <div class="form-group">
                <label>close_date</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>deal_descrip</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>deadline</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>user_id</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>status</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" id="exampleInputFile">

                <p class="help-block">Example block-level help text here.</p>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Check me out
                </label>
            </div>
        </div>
                <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    
</div>
@endsection