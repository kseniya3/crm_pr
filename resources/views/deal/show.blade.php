@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
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
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="box">
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>
@endsection
