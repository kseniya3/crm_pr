@extends('adminlte::page')
@section('content')
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Condensed Full Width Table</h3>
                <form action="{{route('users.find_user')}}" method="post">
                    @csrf
                    <input type="text" name="find" id="find" class="form-control">
                    <button type="submit" class="btn btn-primary">Найти</button>
                </form>
                <div class="box-body no-paddin">
                    <table class="box-body no-paddin">
                        <tbody>
                            
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Task</th>
                                
                                <th style="width: 40px">Label</th>
                            </tr>
                            @foreach ($items as $item)
                            @if (auth()->user()->id!=$item->id)
                            <tr>
                                    
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                
                                <td>{{$item->email}}</td>
                                <td>{{$item->role}}</td>
                                
                                
                                <td><a href="{{route('users.update_user_str',$item->id)}}"><button class="btn btn-primary">Редактировать</button></a></td>
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
                            @endif
                                
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
@endsection