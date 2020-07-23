@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body no-padding">
                        <div class="jumbotron text-center">
                            <form class="form-inline">
                                <div class="form-group mb-2">
                                    <label>Report:</label>
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="staticEmail2" class="sr-only">Email</label>
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                                           value="{{$client->second_name}} {{$client->first_name}} {{$client->middle_name}}">
                                </div>
                                <a href="{{route('clients.generator', $client->id)}}" class="dropdown-item">Report</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
