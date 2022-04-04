@extends('customerViews.layouts.customerlayout')
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

    <div style="padding: 0px 50px 0px 50px;">
        
        <div style="margin-top: 20px;">

          {{-- <div class="container">
              <div class="row">
                <div class="col">

                  <input type="text" id="search" class="form-control" placeholder="Search Clinic Name" aria-label="Search Clinic Name" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2" style="background-color: #B3CDE0"><i class="fa fa-search" aria-hidden="true" style="margin: 4px"></i></span>
                  </div>

                </div>
                <div class="col col-lg-2">
                    Appointment Status:
                </div>
                <div class="col">
                  
                  <select class="form-control" name="status" id="appointStatus" style="float: right; margin-left: 10px; width: 80px;">
                    <option value="AppointStatus">Appointment Status:</option>
                    <option value="1" class="text-success" > &#9733; Done </option>
                    <option value="2" class="text-warning"> &#9733; Pending</option>
                    <option value="3" class="text-danger"> &#9733; Declined</option>
                    <option value="4" class="text-primary"> &#9733; Accepted</option>
                    <option value="5" class="text-muted"> &#9733; Negotiating</option>
                    <option value="6" class="text-danger"> &#9733; Expired</option>
                    <option value="8" class="text-dark"> &#9733; Cancelled</option>
                  </select>   
                  
                </div>
              </div>
          </div> --}}

                
   

                      <div class="input-group mb-3">

                              <input type="text" id="search" class="form-control" placeholder="Search Clinic Name" aria-label="Search Clinic Name" aria-describedby="basic-addon2">

                              <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2" style="background-color: #B3CDE0"><i class="fa fa-search" aria-hidden="true" style="margin: 4px; height:20px"></i></span>
                              </div>

                           
                                {{-- <input id="search" type="text" class="form-control" placeholder="Search Clinic Name" aria-label="Search Clinic Name" aria-describedby="basic-addon2"> 
                    
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search fa-lg" aria-hidden="true" style="padding: 4px;"></i></span>
                                </div> --}}



                              <label for="inputPassword" class="col-sm-2 col-form-label" style="margin-left: 15px; padding-left: 35px; ">Appointment Status:</label>

                              <select name="status" id="appointStatus" style="float: right; width: 150px; padding: 3px; border-radius: 6px">
                                <option value="AppointStatus">Select Status:</option>
                                <option value="1" class="text-success" > &#9733; Done </option>
                                <option value="2" class="text-warning"> &#9733; Pending</option>
                                <option value="3" class="text-danger"> &#9733; Declined</option>
                                <option value="4" class="text-primary"> &#9733; Accepted</option>
                                <option value="5" class="text-muted"> &#9733; Negotiating</option>
                                <option value="6" class="text-danger"> &#9733; Expired</option>
                                <option value="8" class="text-dark"> &#9733; Cancelled</option>
                              </select>   

                      </div>
                                        

                        <br>
                        <div>
                            <div id="appointList">
                                    {{-- <table class="table table-inbox table-hover"  id="mailTable">
                                            <thead>
                                                <tr class="unread">
                                                    <th>ID</th>
                                                    <th>Star</th>
                                                    <th>Clinic</th>
                                                    
                                                
                                                    <th>Message</th>
                                                    <th>Status</th>
                                                    <th>Date Created</th>
                                                    <th>Cancel</th> 
                                                    <th>Delete</th> 
                                                </tr>
                                            </thead>         

                                        
                                            <tbody id="info"></tbody>
                                    </table> --}}

                                    <table class="table table-hover" id="mailTable">
                                        <thead>
                                          <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col"></th>
                                            <th scope="col">Clinic</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                          </tr>
                                        </thead>
                                        <tbody id="info">
                                        </tbody>
                                    </table>

                              
                                    {{-- {{ $customers->lname }}, {{ $customers->fname }} --}}
                           

                        </div>

                        {{-- <nav aria-label="...">
                            <ul class="pagination">
                              <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                              </li>
                              <li class="page-item"><a class="page-link" href="#">1</a></li>
                              <li class="page-item active">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                              </li>
                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                              <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                              </li>
                            </ul>
                        </nav>     --}}


                        
                      
          
        </div>
    </div>

    
    @include('customerViews.mail.modal.delete_modal')
    @include('customerViews.mail.modal.cancel_modal')
    @include('customerViews.mail.modal.accept_modal')
    @include('customerViews.mail.modal.decline_modal')
    @include('customerViews.footer.footer2')
@endsection

@section('jsScript')
        {{-- <script src="{{ URL::asset('js/customer/mail-pagination.js') }}"></script> --}}
        {{-- <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
        <script src="{{ URL::asset('js/customer/mail.js') }}"></script>
        {{-- <script>
            $(document).ready( function () {
                $('#mailTable').DataTable();
            } );
        </script> --}}
        {{-- <script type="text/javascript" src="path_to/jquery.js"></script>
        <script type="text/javascript" src="path_to/jquery.simplePagination.js"></script> --}}
        
@endsection
        


