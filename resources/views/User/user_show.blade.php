@extends('adminlte::page')

@section('content_header')
    <div class="content-header">
        <h1 class="box-title">Users table</h1>
    </div>
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">            
                    <!-- <a href="{{route('users.add_user')}}" class="btn btn-outline-success">Add user</a> -->
                    @if(session()->get('success'))
                        <div class="alert alert-success mt-3">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                
                <div class="box-body no-paddin">

                    <form action="{{route('users.find_user')}}" method="post" class="input-group">
                        @csrf
                        <input type="search" name="find" id="find" class="form-control" placeholder="Enter what you want to find...">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary ">Search</button>
                    </div>
                    </form>

                <div class="card">
                    <table class=" table box-body no-paddin">
                        <thead>
                            <tr role="row" class="box-title">
                                <th scope="col">№</th>
                                <th>Login</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th colspan="2" scope="col"><a href="{{route('users.add_user')}}" class="btn btn-outline-success">Add user</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            @if (auth()->user()->id!=$item->id)
                                <tr>
                                        
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->role}}</td>
                                    
                                    
                                    <td><a href="{{route('users.update_user_str',$item->id)}}"><button class="btn btn-success">
                                    <i class="fa fa-edit"></i>
                                    </button></a></td>
                                    <td>
                                        <form method="POST" action="{{route('users.delete_user',$item->id)}}">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            @endif
                            @endforeach
                        </thead>
                    </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/app.js')}}"></script>
@endpush