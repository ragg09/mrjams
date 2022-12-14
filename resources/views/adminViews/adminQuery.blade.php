@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Admin Query')


@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('./css/admin/newUI.css') }}">
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
                <h3 style="text-decoration-line: underline; "><b>Create a Query</b></h3>
                <form action="{{ route('admin.adminQuery.store') }}" method="POST" id="formQuery">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label"><i class="fa fa-code" aria-hidden="true"
                                style="margin-right:5px;"></i>Insert Query:</label>
                        <textarea class="form-control" id="queryBody" name="queryBody" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><b>Submit</b></button>
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

            <div class="row" id="query_error_div" hidden>
                <div class="colborder">
                    <div class="col-12 w-75 mx-auto rounded" style="background: rgb(207, 0, 0)">
                        <div class=" mx-auto p-1">
                            <p class="text-white">
                                <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
                                <span id="error_message">

                                </span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>





@endsection

@section('extraScript')

    <script src="{{ URL::asset('js/admin/adminQuery.js') }}"></script>

@endsection
