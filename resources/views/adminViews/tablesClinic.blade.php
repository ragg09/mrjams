@extends('adminViews.layouts.master')

@section('title', 'Analytics')


@section('extraStyle')
    
@endsection


@section('content')

    {{-- {{$user}} --}}

<header class="header header-sticky mb-4"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Analytics</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead class="bg-primary">
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Clinic Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Telephone</th>
                        <th scope="col"> </th>
                        <th scope="col">Action</th>
                        <th scope="col"> </th>
                        {{-- <th scope="col">   </th> --}}
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($clinic as $clinics)
                            <tr>
                                <td>{{$clinics['id']}}</td>
                                <td>{{$clinics['name']}}</td>
                                <td>{{$clinics['phone']}}</td>
                                <td>{{$clinics['telephone']}}</td>
                                <td><a href="/admin/clinic/{{$clinics['id']}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a></td>
                                {{-- <td><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</button></td> --}}
                                <td><a href="/admin/clinic/{{$clinics['id']}}/edit" class="btn btn-warning" id="editUser" ><i class="fa fa-pencil-square-o" aria-hidden="true" data-id="{{$clinics['id']}}"></i> Edit</a></td>
                                <td><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <table class="table table-hover ">
                    <thead class="bg-primary">
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col"> </th>
                        <th scope="col">Action</th>
                        <th scope="col"> </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($customer as $customers)
                            <tr>
                                <td>{{$customers['id']}}</td>
                                <td>{{$customers['lname']}}</td>
                                <td>{{$customers['phone']}}</td>
                                <td><a href="/admin/tables/{{$users['id']}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a></td>
                                <td><button class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                <td><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>
{{-- <div id="linechartUsers" style="width: 900px; height: 500px;"></div> --}}

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script>

@endsection
