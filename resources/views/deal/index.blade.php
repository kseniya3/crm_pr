@extends('adminlte::page')

@section('content_header')
    <div class="content-header">
        <h1 class="box-title">Deals table</h1>
    </div>
@endsection

@section('content')
    <div class="col-xs-12" id='vue-id'>
        <div class="box">
            <div class="box-header">
                @if(session()->get('success'))
                    <div class="alert alert-success mt-3">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
                <deal-comp :urldata="{{json_encode($items)}}"></deal-comp>
        </div>
        <div class="nav justify-content-center">
            {{$items->links()}}
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/app.js')}}"></script>
@endpush

