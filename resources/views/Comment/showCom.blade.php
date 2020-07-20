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
                            <strong>Manager:</strong> {{$users->name}}<br>
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
                <div class="box-header with-border">
                    <h3 class="box-title">Comment text</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('comments.store') }}" method="post">
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <input type="hidden" name="deal_id" value="{{$deal->id}}">
                    {{ csrf_field() }}
                    <fieldset class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea name="comment_text" class="form-control">{{$comment->comment_text}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Okay</button>
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
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th style="width: 10%">Filname</th>
                            <th style="width: 10%">Filepath</th>
                            <th></th>
                        </tr>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->created_at}}</td>
                            <td>{{$comment->user_id}}</td>
                            <td>{{$comment->comment_text}}</td>
                            <td class="table-buttons">
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
                                            <a class="dropdown-item" href="">Edit</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody></table>
                </div>
            </div>

            <!-- /.box -->
            <div class="box">
                {{$comments->links()}}
            </div>
        </div>
        <!-- /.col -->
    </div>
@endsection
