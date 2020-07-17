@extends('adminlte::page')

@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Client</h3>
  </div>

   {{--  @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif --}}
    <form role="form" action="{{route('clients.update_client',$data->id)}}" method="post">
        @csrf
        <div class="box-body">
        
          <div class="form-group">
              @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="form-group">
              <label for="second_name">second name</label>
              <input type="text" name="second_name" id="second_name" class="form-control" value="{{$data->second_name}}">
            </div>
            <div class="form-group">
              <label for="first_name">first name</label>
              <input type="text" name="first_name" id="first_name"class="form-control" value="{{$data->first_name}}">
            </div>
            <div class="form-group">
              <label for="middle_name">middle name</label>
              <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{$data->middle_name}}">
            </div>
            <div class="form-group">
              <label for="contacts_telephone">contact phone</label>
              <input type="text" name="contacts_telephone" id="contacts_telephone" class="form-control bfh-phone" data-format="+7(ddd) ddd dd dd" value="{{$data->contacts_telephone}}">
            </div>
            <div class="form-group">  
              <label for="contacts_email">contact_email</label>
              <input type="text" name="contacts_email" id="contacts_email"class="form-control" value="{{$data->contacts_email}}">
            </div>
            <div class="form-group">
              <label for="description">description</label>
              <textarea name="description" id="description" cols="30" rows="10" class="form-control" >{{$data->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="company_name">company name</label>
              <input type="text" name="company_name" id="company_name"class="form-control" value="{{$data->company_name}}">
            </div>
              <div class="form-group">
                <label>Deal</label>
                    @foreach($deals as $deal)
                        <input type="checkbox" name="deals[]" value="{{$deal->id}}">
                        <label class="">{{$deal->deal_name}}</label>
                    @endforeach
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
    </form>
</div>
@endsection