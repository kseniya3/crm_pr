@extends('adminlte::page')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Deal Table</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            {{$deals->links()}}
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Appelation</th>
                            <th style="width: 40px">Deadline</th>
                            <th>Client</th>
                            <th style="width: 40px">Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deals as $deal)
                        <tr>
                            <td>{{ $deal->deal_name }}</td>
                            <td>{{ $deal->deadline }}</td>
                            <td>{{ $deal->clients()->pluck('second_name')->implode(', ')}}</td>
                            @if($deal->status == 'open')
                                <td><span class="badge bg-success">{{ $deal->status }}</span></td>
                            @else
                                <td><span class="badge bg-danger">{{ $deal->status }}</span></td>
                            @endif
                            <td>
                                <a class="btn btn-primary btn-block" href="{{route('comments.show', $deal->id)}}" role="button">Show</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          
        </div>
    </div>
@endsection


