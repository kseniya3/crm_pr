@extends('adminlte::page')

@section('content')
    <!-- <script src="{{asset('js/app.js')}}"></script> -->
<div id="vue-id" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))]
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{route('deals.index')}}">Deal</a>
                    <a href="{{route('clients.show_clients')}}">Client</a>
                    <a href="{{route('users.show_user')}}">User</a>
                    {{ __('You are logged in!') }}
                        <div><example-component></example-component></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{asset('js/app.js')}}"></script>
@endpush
