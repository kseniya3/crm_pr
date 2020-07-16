@extends('adminlte::page')
@section('content')
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Condensed Full Width Table</h3>
                <div class="box-body no-paddin">
                    <form action="{{route('clients.find_client')}}" method="post">
                    @csrf
                    <input type="text" name="find" id="find" class="form-control">
                    <button type="submit" class="btn btn-primary">Найти</button>
                    </form>
                   
                    
                    <table class="box-body no-paddin">
                        <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Task</th>
                                
                                <th style="width: 40px">Label</th>
                            </tr>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->second_name}}</td>
                                    <td>{{$item->first_name}}</td>
                                    <td>{{$item->middle_name}}</td>
                                    <td>{{$item->contacts_telephone}}</td>
                                    <td>{{$item->contacts_email}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->company_name}}</td>
                                    <td>
                                        <form method="POST" action="{{route('clients.delete_client',$item->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    
                                    
                                    <td><a href="{{route('clients.update_client_str',$item->id)}}"><button class="btn btn-primary">Редактировать</button></a></td>
                                    
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
@endsection