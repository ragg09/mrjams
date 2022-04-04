@extends('customerViews.layouts.customerlayout')
@section('specificStyle')

    <link rel="stylesheet" href="{{asset('./css/customer/profile-content.css')}}">

@endsection
@section('content')
@include('customerViews.header.header3')

        <div class="container" style="margin-top: 20px; " id="profile">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card" style="padding:30px;">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{Auth::user()->avatar}}" alt="customer" class="rounded-circle p-1 bg-dark" width="110">
                                    <div class="mt-3">
                                       
                                        <h4>{{$customer->fname}} {{$customer->lname}}</h4>
                                    
                                        <p class="text-secondary mb-1">{{Auth::user()->email}}</p>
                                      
                                        <p class="text-muted font-size-sm">{{$address->address_line_1}}, {{$address->address_line_2}}</p>
                                   
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">

                        <form action="/customer/customerinfo/{{Auth::user()->id}}" method="POST" id="main_form">
                            @csrf
                            {{method_field('PUT')}}

                            {{-- san js bka wala namn talga problema lags, try mo mag clear cache route config --}}

                            <div class="card" style="padding:30px;">
                                <div class="card-body" style="width: 100%">
                                   
                                    <div class="row mb-3" >
                                        <div class="col-sm-3" style="margin-top: 2%;">
                                            <h6 class="mb-0">First Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="fname" value="{{$customer->fname}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3" style="margin-top: 2%;">
                                            <h6 class="mb-0">Last Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="lname" value="{{$customer->lname}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3" style="margin-top: 2%;">
                                            <h6 class="mb-0">Age</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="age" value="{{$customer->age}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3" style="margin-top: 2%;">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$customer->phone}}">
                                        </div>
                                    </div>
                               
                                    <div class="row mb-3">
                                        <div class="col-sm-3" style="margin-top: 2%;">
                                            <h6 class="mb-0">Address Line 1</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="addline1" value="{{$address->address_line_1}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3" style="margin-top: 2%;">
                                            <h6 class="mb-0">Address Line 2</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="addline2" value="{{$address->address_line_2}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3" style="margin-top: 2%;">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">City</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="city" value="{{$address->city}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3" style="margin-top: 2%;">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Zip Code</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="zipcode" value="{{$address->zip_code}}">
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input  type="submit" id="submit" name="submit" class="btn btn-primary px-4" value="Save Changes">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                
                    </div>
                </div>
            </div>
        </div>
@include('customerViews.footer.footer2')
@endsection
@section('jsScript')

{{-- san ung controllert --}}
    <script src="{{ URL::asset('js/customer/profile.js') }}"></script>
@endsection
