@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="jumbotron text-center">
                    <h2>{{$deal->deal_name}}</h2>
                    <p>
                        <strong>Start date:</strong> {{$deal->open_date}}<br>
                        <strong>Finish date:</strong> {{$deal->close_date}}<br>
                        <strong>Description:</strong> {{$deal->deal_descrip}}<br>
                        <strong>Deadline:</strong> {{$deal->deadline}}<br>
                        <strong>Manager:</strong> {{$deal->user->name}}<br>
                        <strong>Client:</strong>
                        @foreach($deal->clients as $client )
                            {{$client->second_name}}
                        @endforeach
                        <br>
                        <strong>Status:</strong> {{ $deal->status }}<br>
                    </p>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="box box-primary">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{route('comments.update', $comments->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <h3 class="box-title">Comment Edit</h3>
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="deal_id" value="{{$deal->id}}">
                {{ csrf_field() }}
                <fieldset class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="comment_text"
                                   value="{{$comments->comment_text}}" class="form-control" id="post-title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit">Edit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
                <form role="form" action="{{ route('comments.storeFile') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="comment_id" value="{{$comments->id}}">
                    {{ csrf_field() }}
                    <fieldset class="form-horizontal">
                        <div class="form-group" style="display:flex;">
                            <label class="col-sm-2 control-label" for="exampleInputFile">File name:</label>
                            <input type="text" name="filename" class="form-control" value="{{old('filename')}}">
                            <input type="file" name="file_path" id="filename" id="exampleInputFile">
                        </div>
                        <div class="form-group">
                            <dvi class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </dvi>
                        </div>
                    </fieldset>
                </form>
        </div>
    </div>
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
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <th style="width: 10%">№</th>
                    <th style="width: 90%">Name File</th>
                    <th></th>
                </tr>
                @if($commentFiles->count() >= 1)
                    @foreach($commentFiles as $commentFile)
                <tr>
                        <td>{{$commentFile->id}}</td>
                        <td>{{$commentFile->filename}}</td>
                    <td class="table-buttons">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-outline-danger dropdown-toggle"
                                    data-toggle="dropdown" aria-hasopup="true" aria-expended="false">
                                <!-- <i class="fa fa-trash"></i> -->Actions
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <form method="POST" action="{{ route('comments.destroyFile', $commentFile->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item">Delete</button>
                                    </form>
                                </li>
                                <li>
                                    <a href="{{ Storage::url($commentFile->file_path) }}" download>{{$commentFile->filename }}</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                    @endforeach
                @endif
                </tbody></table>
        </div>
</div>
</div>
@endsection
