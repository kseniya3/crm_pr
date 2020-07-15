
@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="box">
        <section style ="margin:0; font-size:24px; line-height:5px;">
            <h1>Deals table</h1>
        </section>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th>Progress</th>
                        <th style="width: 40px">Label</th>
                    </tr>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->deal_name }}</td>
                        <td>{{ $item->open_date }}</td>
                        <td>{{ $item->close_date }}</td>
                        <td>{{ $item->deal_descrip }}</td>
                        <td>{{ $item->deadline }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-red">55%</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <a href="{{route('deals.create')}}"><button type="submit" class="btn btn-primary">Add deal</button></a>
            <!-- <a href="{{route('deals.create')}}">Deal</a> -->
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endsection

