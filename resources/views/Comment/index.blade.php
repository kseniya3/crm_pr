@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div>
                        <h1>Deals and Comment</h1>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="jumbotron text-center">
                            <h2>{{$deal->deal_name}}</h2>
                            <p>
                                <strong>Start date:</strong> {{$deal->open_date}}<br>
                                <strong>Finish date:</strong> {{$deal->close_date}}<br>
                                <strong>Description:</strong> {{$deal->deal_descrip}}<br>
                                <strong>Deadline:</strong> {{$deal->deadline}}<br>
                                <strong>Manager:</strong> {{$deal->user->name}} <br>
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
                <div class="box box-primary">
                    <form role="form" action="{{ route('comments.store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="deal_id" value="{{$deal->id}}">
                        {{ csrf_field() }}
                        <fieldset class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-14">
                                    <label>Comment:</label>
                                    <textarea name="comment_text" class="form-control"></textarea>
                                </div>
                            </div>
                            <label style="width: 15%"for="exampleInputFile">File name:</label>
                            <div class="form-group col-md-14" style="display: flex">
                                <input style="width: 60%" type="text" name="filename" class="form-control" value="{{old('filename')}}">
                                <input type="file" name="file_path" id="filename" id="exampleInputFile">
                            </div>
                            <div class="form-group">
                                <div class="col-sm-14 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">Add Comment</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 10%">Data</th>
                                <th style="width: 10%">User</th>
                                <th style="width: 70%">Comment</th>
                                <th style="width: 70%">File</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->created_at}}</td>
                                    <td>{{$comment->users->name}}</td>
                                    <td>{{$comment->comment_text}}</td>
                                    <td>{{$comment->commentsFile()->count()}}</td>
                                    <td>
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-outline-danger dropdown-toggle"
                                                    data-toggle="dropdown" aria-hasopup="true" aria-expended="false">
                                                <!-- <i class="fa fa-trash"></i> -->Actions
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <form method="POST" action="{{route('comments.destroy', $comment->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item">Delete</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('comments.edit', $comment->id)}}">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <div class="nav justify-content-center">
                                {{$comments->links()}}
                            </div>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>
@endsection
