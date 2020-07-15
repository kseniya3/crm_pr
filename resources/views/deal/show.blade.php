@extends('adminlte::page')

@section('content')
<a href="{{route('deals.create')}}" class="btn btn-success">Добавить сделку</a>
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{route('deals.index')}}">View</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{route('deals.index')}}">View</a></li>
        <li><a href="{{route('deals.create')}}">Create</a>
    </ul>
</nav>

<h1>Showing {{ $deal->deal_name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $deal->deal_name }}</h2>
        <p>
            <strong>open_date:</strong> {{ $deal->open_date }}<br>
            <strong>close_date:</strong> {{ $deal->close_date }}<br>
            <strong>deal_descrip:</strong> {{ $deal->deal_descrip }}<br>
            <strong>deadline:</strong> {{ $deal->deadline }}<br>
            <strong>user_id:</strong> {{ $deal->user_id }}<br>
            <strong>status:</strong> {{ $deal->status }}<br>
        </p>
    </div>
@endsection