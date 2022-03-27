@extends('customerViews.layouts.customerlayout')
@section('specificStyle')
    {{-- <link rel="stylesheet" href="{{asset('./css/customer/mail.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('./css/customer/mail-content.css')}}">
   
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src ="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> --}}
    
@endsection
@section('content')
@include('customerViews.mail.mail-edit')
@include('customerViews.header.header2')

    <div class="container">
        
        <div class="mail-box" style="margin-top: 20px;">
                <aside class="lg-side">
                        <div class="inbox-head">
                        
                                        {{-- <select class="dpselect" name="state" id="maxRows">
                                            <option value="5000">All</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="70">70</option>
                                            <option value="100">100</option>
                                        </select>    --}}

                                        <select class="dpselect" name="status" id="appointStatus">
                                            <option value="AppointStatus">Appointment Status:</option>
                                            <option value="1" class="text-success" > &#9733; Done </option>
                                            <option value="2" class="text-warning"> &#9733; Pending</option>
                                            <option value="3" class="text-danger"> &#9733; Declined</option>
                                            <option value="4" class="text-primary"> &#9733; Accepted</option>
                                            <option value="5" class="text-muted"> &#9733; Negotiating</option>
                                            <option value="6" class="text-danger"> &#9733; Expired</option>
                                          
                                        </select>   


                                    
                        </div>

                        <br>
                        <div class="inbox-body">
                            <div id="appointList">
                                <table class="table table-inbox table-hover"  id="">
                                        <thead>
                                            <tr class="unread">
                                                <th class="tbhead">ID</th>
                                                <th></th>
                                                <th class="tbhead">Clinic</th>
                                                
                                             
                                                <th class="tbhead"></th>
                                                <th></th>
                                                <th class="tbhead">Date Created</th>
                                                
                                                <th></th> 
                                            </tr>
                                        </thead>         

                                    
                                        <tbody id="info"></tbody>
                                </table>

                              
                                    {{-- {{ $customers->lname }}, {{ $customers->fname }} --}}
                           

                            </div>

                                       
                                                {{-- <div class='pagination-container' >
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li data-page="prev" >
                                                                <span> < <span class="sr-only">(current)</span></span>
                                                            </li>
                                                  
                                                            <li data-page="next" id="prev">
                                                                <span> > <span class="sr-only">(current)</span></span>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div> --}}

                                   
                </aside>
        </div>
    </div>

    
  
@include('customerViews.footer.footer2')
@endsection

@section('jsScript')
        {{-- <script src="{{ URL::asset('js/customer/mail-pagination.js') }}"></script> --}}
        <script src="{{ URL::asset('js/customer/mail.js') }}"></script>
@endsection
        


