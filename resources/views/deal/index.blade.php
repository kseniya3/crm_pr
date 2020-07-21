@extends('adminlte::page')

@section('content_header')
    <div class="content-header">
        <h1 class="box-title">Deals table</h1>
    </div>
@endsection

@section('content')

    <div class="col-xs-12" id='dealVue'>
        <div class="box">
            <div class="box-header">
                <a href="{{route('deals.create')}}" class="btn btn-outline-success">Add deal</a>
                @if(session()->get('success'))
                    <div class="alert alert-success mt-3">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>

<div>
    <deal-comp></deal-comp>
</div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table class="table table-bordered table-hover dataTable" role="grid">
            <thead>
              <tr role="row" class="box-title">
                <th scope="col">№</th>
                <th scope="col">Appelation</th>
                <th scope="col">Start date</th>
                <th scope="col">Finish date</th>
                <th scope="col">Description</th>
                <th scope="col">Deadline</th>
                <th scope="col">Manager</th>
                <th scope="col">Client</th>
                <th scope="col">Comment</th>
                <th scope="col">Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $item)
                  @foreach($users as $user)
              <tr class="lead">
                @if($item->user_id === $user->id)
                  <td scope="row">{{ $item->id }}</td>
                  <td>{{ $item->deal_name }}</td>
                  <td>{{ $item->open_date }}</td>
                  <td>{{ $item->close_date }}</td>
                  <td>{{ $item->deal_descrip }}</td>
                  <td>{{ $item->deadline }}</td>
                  
                      <td>{{ $user->name }}</td>
                  
                  <td>{{ $item->clients()->pluck('second_name')->implode(', ')}}</td>
                  <td> <a href="{{route('comments.show', $item->id)}}">Comment</a></td>
                  <td>{{ $item->status }}</td>

                <td class="table-buttons">
                  <div class="input-group-btn">
                  <button type="submit" class="btn btn-outline-danger dropdown-toggle"
                        data-toggle="dropdown" aria-hasopup="true" aria-expended="false">
                          <!-- <i class="fa fa-trash"></i> -->Actions
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                          <form method="POST" action="{{ route('deals.destroy', $item->id) }}">
                              @csrf
                              @method('DELETE')
                              <button class="dropdown-item">Delete</button>
                          </form>
                          </li>
                          <li>
                          <a class="dropdown-item" href="{{ route('deals.edit', $item->id) }}">Edit</a>
                          </li>
                        </ul>
                  </div>
                  </td>
              </tr>
              @endif
              @endforeach
            @endforeach
            </tbody>
          </table>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{asset('js/app.js')}}"></script>
@endpush
