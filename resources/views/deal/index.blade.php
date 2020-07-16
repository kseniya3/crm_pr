@extends('adminlte::page')

@section('content')
<a href="{{route('deals.create')}}" class="btn btn-success">Добавить сделку</a>

 @if(session()->get('success'))
    <div class="alert alert-success mt-3">
      {{ session()->get('success') }}
    </div>
@endif

<table class="table table-striped mt-3">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">deal_name</th>
      <th scope="col">open_date</th>
      <th scope="col">close_date</th>
      <th scope="col">deal_descrip</th>
      <th scope="col">deadline</th>
      <th scope="col">manager</th>

      <th scope="col">status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
   @foreach($items as $item)
       @foreach($users as $user)

    <tr>
        <td scope="row">{{ $item->id }}</td>
        <td>{{ $item->deal_name }}</td>
        <td>{{ $item->open_date }}</td>
        <td>{{ $item->close_date }}</td>
        <td>{{ $item->deal_descrip }}</td>
        <td>{{ $item->deadline }}</td>
        @if($item->user_id === $user->id)
            <td>{{ $user->name }}</td>
        @endif
        <td>{{ $item->status }}</td>
      <td class="table-buttons">
        <a href="{{ route('deals.edit', $item->id) }}"  class="btn btn-primary">
          <i class="fa fa-eye"></i>
        </a>
        <form method="POST" action="{{ route('deals.destroy', $item->id) }}">
         @csrf
         @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="fa fa-trash"></i>
            </button>
        </form>
      </td>
    </tr>

       @endforeach
  @endforeach
  </tbody>
</table>
@endsection
