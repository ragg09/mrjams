@extends('adminViews.layouts.master')

@section('title', 'Reply')


@section('extraStyle')
    
@endsection

{{-- {{ $message->message}} --}}

@section('content')
<header class="header header-sticky mb-4"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Message</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <h3>Reply</h3>
            <form action="/admin/message/0" method="POST">
              @csrf
              {{method_field('PUT')}}
                <div class="mb-3">
                  <input class="form-control" id="sender" name="sender" type="text" value="{{$sender->email}}" disabled>
                  <input class="form-control" id="sender" name="sender" type="text" value="{{$sender->email}}" hidden>

                  {{-- <input class="form-control" id="disabledInput" type="text" disabled> --}}
                  <label class="form-label">Message/Announcement</label>
                  <textarea class="form-control" id="messageBody" name="messageBody" rows="3" disabled>{{ $message->message}}</textarea>
                  <label class="form-label">Reply</label>
                  <textarea class="form-control" id="messageReply" name="messageReply" rows="3"></textarea>
                  {{-- <input type="text" class="form-control" id="messageBody" aria-describedby="emailHelp"> --}}
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/message.js') }}"></script>

@endsection
