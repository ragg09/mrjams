@extends('adminViews.layouts.master')

@section('title', 'Message')


@section('extraStyle')
    
@endsection


{{-- {{$messageSender}} --}}

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
            <h3>Message</h3>
            <a href="{{ route('admin.message.create') }}">Create</a>
            <a href="/admin/message/1">Sent</a>
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead class="bg-primary">
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Message</th>
                        <th scope="col">From</th>
                        <th scope="col">Action</th>
                        {{-- <th scope="col"> </th> --}}
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($adminMessage as $adminMessages)
                            <tr>
                                <td>{{$adminMessages['id']}}</td>
                                <td>{{$adminMessages['message']}}</td>
                                <td>{{$adminMessages['users_id']}}</td>
                                {{-- <td>{{$clinics['phone']}}</td>
                                <td>{{$clinics['telephone']}}</td> --}}
                                {{-- <td><a href="/admin/message/{{$adminMessages['id']}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Reply</button></a></td> --}}
                                <td><a href="/admin/message/{{$adminMessages['id']}}/edit"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Reply</button></a></td>
                                {{-- <td><a href="/admin/clinic/{{$clinics['id']}}/edit" class="btn btn-warning" id="editUser" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td> --}}
                                {{-- <td><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <h1>{{$details['title']}}</h1>
                <h1>{{$details['body']}}</h1> --}}

            </div>
        </div>
    </div>
</div>

@endsection

@section('extraScript')

{{-- <script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script> --}}

@endsection
