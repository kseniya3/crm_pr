@extends('adminlte::page')
@section('content')
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Condensed Full Width Table</h3>
                <div class="box-body no-paddin">
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
                                    <td><a href="{{route('clients.delete_client',$item->id)}}"><button class="btn btn-warning">Удалить</button></a></td>
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