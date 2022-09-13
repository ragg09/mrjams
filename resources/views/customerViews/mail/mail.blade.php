@extends('customerViews.layouts.customerlayout')
@section('title', 'MR. JAMS - Appointments ')
@section('specificStyle')
    {{-- <link rel="stylesheet" href="{{asset('./css/customer/mail.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('./css/customer/mail-content.css')}}"> --}}
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}

    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src ="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> --}}
    {{-- <link type="text/css" rel="stylesheet" href="path_to/simplePagination.css"/> --}}

@endsection
@section('content')
    @include('customerViews.mail.mail-edit')
    @include('customerViews.header.header2')

    <div style="padding: 0px 60px 0px 60px;">

        <div style="margin-top: 20px;">

            {{-- <div class="input-group mb-3">

                              <input type="text" id="search" class="form-control" placeholder="Search Clinic Name" aria-label="Search Clinic Name" aria-describedby="basic-addon2">

                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2" style="background-color: #B3CDE0"><i class="fa fa-search" aria-hidden="true" style="margin: 4px; height:20px"></i></span>
                              </div>


                              <label for="inputPassword" class="col-sm-2 col-form-label" style="margin-left: 7x; padding-left: 15px; "><b>Appointment Status:</b></label>

                              <select name="status" id="appointStatus" style="float: right; width: 150px; padding: 3px; border-radius: 6px">
                                <option value="AppointStatus">Select Status:</option>
                                <option value="1" class="text-success" > &#9733; Done </option>
                                <option value="2" class="text-warning"> &#9733; Pending</option>
                                <option value="4" class="text-primary"> &#9733; Accepted</option>

                              </select>

                      </div> --}}

            {{-- filter: appointment status --}}
            {{-- <option value="3" class="text-danger"> &#9733; Declined</option>
                                <option value="5" class="text-muted"> &#9733; Negotiating</option>
                                <option value="6" class="text-danger"> &#9733; Expired</option>
                                <option value="8" class="text-dark"> &#9733; Cancelled</option> --}}


            <div>
                <div id="appointList">

                    <table class="row-border hover" id="mailTable" style="background-color: #B3CDE0">
                        <div id="mailTableReload">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fa fa-star" aria-hidden="true"></i></th>
                                    {{-- <th scope="col">ID</th> --}}
                                    <th scope="col">Clinic</th>
                                    <th scope="col">Message</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Date Created</th>
                                    <th scope="col" class="text-center">Action</th>
                                    {{-- <th scope="col"></th> --}}
                                </tr>
                            </thead>
                            <tbody id="info">
                            </tbody>
                        </div>
                    </table>


                    {{-- {{ $customers->lname }}, {{ $customers->fname }} --}}


                </div>


            </div>
        </div>


        @include('customerViews.mail.modal.delete_modal')
        @include('customerViews.mail.modal.cancel_modal')
        @include('customerViews.mail.modal.accept_modal')
        @include('customerViews.mail.modal.decline_modal')
        @include('customerViews.footer.footer2')


    @endsection

    @section('jsScript')

        <script src="{{ URL::asset('js/customer/mail.js') }}"></script>

    @endsection
