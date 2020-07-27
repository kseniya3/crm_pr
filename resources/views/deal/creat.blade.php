@extends('adminlte::page')

@section('content')


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Deal</h3>
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

    <form role="form" method="POST" action="{{route('deals.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>deal_name</label>
                    <input type="text" name="deal_name" class="form-control" value="{{old('deal_name')}}">
                </div>
    
    
                {{-- <div class="form-group">
                    <label>close_date</label>
                    <input type="dateTime-local" name="close_date" class="form-control" value="{{old('close_date')}}">
                </div> --}}
                <div class="form-group">
                    <label>deal_descrip</label>
                    <input type="text" name="deal_descrip" class="form-control" value="{{old('deal_descrip')}}">
                </div>
                <div class="form-group">
                    <label>deadline</label>
                    <input type="dateTime-local" name="deadline" class="form-control" value="{{old('deadline')}}">
                </div>
            </div>
            <div class="col-sm">
                <label>Cient</label>
                <div class="form-group rast" id="prokrutka">
                
                    @foreach($clients as $client)
                        <input type="checkbox" name="clients[]" value="{{$client->id}}">
                        <label class="">{{$client->second_name}}</label>
                        <br>  
                    @endforeach
                </div>
            </div>

            <div class="col-sm">
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                {{ csrf_field() }}
                <fieldset class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Comment:</label>
                        <div class="col-sm-12">
                            <textarea name="comment_text" class="form-control"></textarea>
                        </div>
                    </div>
                </fieldset>
<<<<<<< HEAD
            {{--  <div class="form-group">
=======
            </div>
        </div>
    </div>
        <div class="box-body">
            
            
                
           {{--  <div class="form-group">
>>>>>>> 49f0148afb2873768cb34da847a37572b4aa8b27
                <label for="post-title">status</label>
                <select name="status" class="form-control" value="{{old('status')}}">
                    <option >Open</option>
                    <option >Closed</option>
                </select>
            </div> --}}

        </div>
                <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>

@endsection
<style>
    #prokrutka {
    height: 200px; /* высота нашего блока */
    width: 100%; /* ширина нашего блока */
    background: #fff; /* цвет фона, белый */
    border: 1px solid #C1C1C1; /* размер и цвет границы блока */
    overflow-x: scroll; /* прокрутка по горизонтали */
    overflow-y: scroll; /* прокрутка по вертикали */
    }
    
    </style>