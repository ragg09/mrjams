@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Admin Query')


@section('extraStyle')
    
@endsection


@section('content')
<header class="header header-sticky mb-2 mt-5"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2" style="background-color: #B3CDE0">
          <li class="breadcrumb-item" style="margin-left: 20px;">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Admin Query</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <h3><b>Create a Query</b></h3>
            <form action="{{ route('admin.adminQuery.store') }}" method="POST" id="formQuery">
              @csrf
                <div class="mb-2">
                  <label class="form-label"><i class="fa fa-code" aria-hidden="true" style="margin-right:5px;"></i>Insert Query:</label>
                  <textarea class="form-control" id="queryBody" name="queryBody" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <br>
                {{-- <label class="form-label mt-2"><i class="fa fa-code" aria-hidden="true" style="margin-right:5px;"></i>select * from users</label> --}}
                {{-- <textarea class="form-control" id="queryBody" name="queryBody" rows="3" value="{{ csrf_token() }}"></textarea> --}}
              </form>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr id="queryHead">
                    {{-- <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th> --}}
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
        </div>
    </div>
</div>



@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/adminQuery.js') }}"></script>

@endsection
