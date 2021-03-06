@extends('adminlte::page')

@section('content_header')
<div class="content-header">
    <h1 class="box-title">Clients table</h1>
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
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                    <table class="table">
                        <thead>
                        <tr role="row" class="box-title">
                            <th scope="col">№</th>
                            <th scope="col">Second name</th>
                            <th scope="col">First name</th>
                            <th scope="col">Middle name</th>
                            <th scope="col">Contact phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Description</th>
                            <th scope="col">Company</th>
                            <th scope="col">Deal</th>
                            <th>
                                <a href="{{route('clients.client-add-form')}}" class="btn btn-success btn-block">Add client</a>
                            </th>
                        </tr>
                        </thead>
                        <div class="box-body no-paddin">
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->second_name}}</td>
                                    <td>{{$item->first_name}}</td>
                                    <td>{{$item->middle_name}}</td>
                                    <td>{{$item->contacts_telephone}}</td>
                                    <td>{{$item->contacts_email}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->company_name}}</td>
                                    <td>{{ $item->deals()->pluck('deal_name')->implode(', ')}}</td>
                                    <td class="table-buttons">
                                        <div class="input-group-btn">
                                            <button class="btn btn-outline-danger dropdown-toggle" data-toggle="dropdown" aria-hasopup="true" aria-expended="false">Actions</button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <form method="POST" action="{{route('clients.delete_client',$item->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a href="{{route('clients.update_client_str',$item->id)}}" class="dropdown-item">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('clients.show_report',$item->id)}}" class="dropdown-item">Report</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </div>
                    </table>
                    </div>
                </div>
                {{$items->links()}}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/app.js')}}"></script>
@endpush
