@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Message')


@section('extraStyle')
    
@endsection


{{-- {{$sender}} --}}

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
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            {{-- <h3><b>Message</b></h3> --}}
            <button class="btn btn-info mb-2" style="width: 200px; margin-right: 5px"><a href="{{ route('admin.message.create') }}" style="color: black">Create</a></button>
            <button class="btn btn-warning mb-2"  style="width: 200px"><a href="/admin/message/1" style="color: black">Announcement</a></button>
            <div class="table-responsive">
                <table class="table table-hover" id="messageTable">
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
                        @foreach($formatted_data_message as $adminMessages)
                            <tr>
                                <td>{{$adminMessages['id']}}</td>
                                <td>{{$adminMessages['message']}}</td>
                                <td>{{$adminMessages['sender']}}</td>
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
            </div>
        </div>
    </div>
</div>

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/message.js') }}"></script>

@endsection
