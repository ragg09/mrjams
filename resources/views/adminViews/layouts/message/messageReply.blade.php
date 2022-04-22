@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Message - Reply')


@section('extraStyle')
<link href="{{ asset('css/admin/messageReply.css') }}" rel="stylesheet">
@endsection

{{-- {{ $message->message}} --}}

@section('content')
<header class="header header-sticky mb-2 mt-5"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2" style="background-color: #B3CDE0">
            <li class="breadcrumb-item" style="margin-left: 20px;">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Message</span>
              </li>
              <li class="breadcrumb-item active">
                <span>Reply</span>
            </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>

<main class="content">
    <div class="container p-0">

		{{-- <h1 class="h3 mb-3">Messages</h1> --}}
        <form action="/admin/message/0" method="POST">
            @csrf
            {{method_field('PUT')}}
                <div class="card">
                    <div class="row g-0">
                            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                <div class="d-flex align-items-center py-1">
                                    <div class="position-relative" style="margin-left: 35px">
                                        <img src="{{$sender->avatar}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    </div>
                                    <div class="flex-grow-1 pl-0">
                                        <strong>{{$sender->email}}</strong>
                                        <input class="form-control" id="sender" name="sender" type="text" value="{{$sender->email}}" hidden>
                                        <div class="text-muted small"><em>{{ date("M j, Y", strtotime($message->created_at))}}</em></div>
                                    </div>
                                
                                </div>
                            </div>

                            <div class="position-relative">
                                <div class="chat-messages p-4">

                                    

                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="{{$sender->avatar}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">{{  date("h:i A", strtotime($message->created_at)) }}</div>
                                        </div>
                                        <div class="flex-shrink-1 rounded py-2 px-3 ml-3" style="background-color: #B3CDE0">
                                            <div class="font-weight-bold mb-1" id="sender" name="sender" type="text">{{$sender->email}}</div>
                                            <div id="messageBody" name="messageBody">{{ $message->message}}</div>
                                        </div>
                                    </div>

                                    {{-- <div class="chat-message-right mb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:38 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                        </div>
                                    </div> --}}


                                </div>
                            </div>

                            <div class="flex-grow-0 py-3 px-4 border-top">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type your message" id="messageReply" name="messageReply" >
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>

                    </div>
                </div>
        </form>
	</div>
</main>
{{-- <div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <h3>Reply</h3>
            <form action="/admin/message/0" method="POST">
              @csrf
              {{method_field('PUT')}}
                <div class="mb-3">
                  <input class="form-control" id="sender" name="sender" type="text" value="{{$sender->email}}" disabled>
                  <input class="form-control" id="sender" name="sender" type="text" value="{{$sender->email}}" hidden>

                  
                  <label class="form-label">Message/Announcement</label>
                  <textarea class="form-control" id="messageBody" name="messageBody" rows="3" disabled>{{ $message->message}}</textarea>
                  <label class="form-label">Reply</label>
                  <textarea class="form-control" id="messageReply" name="messageReply" rows="3"></textarea>
                 
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div> --}}

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/message.js') }}"></script>

@endsection
