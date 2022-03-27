@extends('adminViews.layouts.master')

@section('title', 'Create Message')


@section('extraStyle')
    
@endsection


@section('content')
<header class="header header-sticky mb-4"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Create Message</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <h3>Create a Message</h3>
            <form action="{{ route('admin.message.store') }}" method="POST">
              @csrf
                <div class="mb-3">
                  <select class="form-select" aria-label="Default select example" id="messageSelect" name="messageSelect">
                    <option selected></option>
                    <option value="all">All</option>
                    <option value="clinic">Clinic</option>
                    <option value="patient">Patient</option>
                  </select>
                  <label class="form-label">Message/Announcement</label>
                  <textarea class="form-control" id="messageBody" name="messageBody" rows="3" value="{{ csrf_token() }}"></textarea>
                  {{-- <input type="text" class="form-control" id="messageBody" aria-describedby="emailHelp"> --}}
                </div>
                
                {{-- <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>


@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script>

@endsection


