@extends('layouts.customerlayout1')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/mail.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/mail-content.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('./css/customer/appoint-modal.css')}}"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
    
@endsection
@section('content')
@include('customerViews.mail.mail-edit');
    <div class="container">
        <!-- <i class="fa fa-star" aria-hidden="true"></i> -->
        <div class="mail-box">
                <aside class="lg-side">
                        <div class="inbox-head">
                        
                                        <select class="dpselect" name="state" id="maxRows">
                                            <option value="5000">All</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="70">70</option>
                                            <option value="100">100</option>
                                        </select>   

                                        <select class="dpselect" name="status" id="appointStatus">
                                            <option value="AppointStatus">Appointment Status:</option>
                                            <option value="1" class="text-success" > &#9733; Done </option>
                                            <option value="2" class="text-warning"> &#9733; Pending</option>
                                            <option value="3" class="text-danger"> &#9733; Declined</option>
                                            <option value="4" class="text-primary"> &#9733; Accepted</option>
                                            <option value="5" class="text-muted"> &#9733; Negotiating</option>
                                            <option value="6" class="text-danger"> &#9733; Expired</option>
                                          
                                        </select>   


                                    <form action="#" class="pull-right position">
                                            <div class="input-append">
                                                <input type="text" class="sr-input" placeholder="Search Mail">
                                                <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                                            </div>
                                    </form>
                        </div>

                        <div class="inbox-body">
                            <div id="appointList">
                                <table class="table table-inbox table-hover"  id="">
                                        <thead>
                                            <tr class="unread">
                                                <th></th>
                                                <th class="tbhead">Clinic</th>
                                                <!-- <th class="tbhead">Appointment ID</th> -->
                                                <th class="tbhead">Details</th>
                                                <th class="tbhead">Appointment Date</th>
                                                <th class="tbhead">Date Created</th>
                                                <th></th>
                                            </tr>
                                        </thead>         

                                    
                                        <tbody id="info"></tbody>
                                </table>
                            </div>

                                        <!--		Start Pagination -->
                                                <div class='pagination-container' >
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li data-page="prev" >
                                                                <span> < <span class="sr-only">(current)</span></span>
                                                            </li>
                                                    <!--	Here the JS Function Will Add the Rows -->
                                                            <li data-page="next" id="prev">
                                                                <span> > <span class="sr-only">(current)</span></span>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>

                                    <!--		End of Container -->
                                    <!-- </div> -->
                </aside>
        </div>
    </div>

         <!--Info Modal Templates-->
         <div id="demo-modal" class="modal modal-message modal-info fade" style="display: none;" aria-hidden="true" aria-labelledby="demo-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <!-- <div class="modal-title">Alert</div> -->
                    <center><h2><img src="{{ URL::asset('images/mrjams/logowithname.png') }}" width="220px" height="90px" class="center"></h2></center>

                    <div class="modal-body">For whom is this appointment?</div>
                    <div class="modal-footer" >
                        <button type="button" class="btn btn-info" data-dismiss="modal" onclick="window.location.href='{{route('customer.appointment.create')}}';">Myself</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal" onclick="window.location.href='{{route('customer.relativeappoint.create')}}';">For my relative or friend</button>
                    </div>
                </div> <!-- / .modal-content -->
            </div> <!-- / .modal-dialog -->
        </div>
        <!--End Info Modal Templates--> 
@endsection

@section('jsScript')
        <script src="{{ URL::asset('js/customer/mail-pagination.js') }}"></script>
        <script src="{{ URL::asset('js/customer/mail.js') }}"></script>
@endsection
        


