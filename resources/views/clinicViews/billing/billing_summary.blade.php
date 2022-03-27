@extends('clinicViews.layouts.master')
@section('title', 'Billing')
@section('extraStyle')
    <style>
        :root {
            --varyDarkBlue: hsl(234, 12%, 34%);
            --grayishBlue: hsl(229, 6%, 66%);
            --veryLightGray: hsl(0, 0%, 98%);
        }

        #box{
            box-shadow: 0px 40px 50px -20px var(--grayishBlue);
            border-top: 5px solid #80adcb;
        }

    </style>
@endsection

@section('content')
    <form action="/clinic/billing/{{ $complete_summary->ro_id }}" method="POST" id="finish_appointment_form">
        @csrf
        {{method_field('PUT')}}
        <div class="row">
            <div class="col-lg-6  p-3">
                <div class="rounded p-3" id="box">
                    <h6><i class="fa fa-user" aria-hidden="true"></i> Account holder</h6>
                    <div class="mx-auto w-75">
                        <p>{{ $complete_summary->name }}</p>
                        <p>{{ $complete_summary->phone }}</p>
                        <p>{{ $complete_summary->address }}</p>
                    </div>

                    <h6><i class="fa fa-wrench" aria-hidden="true"></i> Tools & Equipments</h6>
                    <div class="mx-auto w-75">
                        <div class="row">
                            <div class="col"><h6>Name</h6></div>
                            <div class="col d-flex justify-content-center"><h6>Quantity</h6></div>
                        </div>
                        
                        @if ($complete_equipments)
                            <div class="overall_equipments">
                                @foreach ($complete_equipments as $row)
                                    <div class="row">
                                        <div class="col"><p>{{ $row->name }} ({{ $row->unit }})</p></div>
                                        <div class="col"><input type="number" class=" positive-numeric-only" min="1" max="{{ $row->max_quantity }}" value="{{ $row->min_quantity }}" id="equipment_values" name="equipment_values" ></div>
                                    </div>
                                @endforeach

                                <div id="addtional_equipment">
                                </div>
                            </div>
                        @endif
                        
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6  p-3">
                <div class="rounded p-3" id="box">
                    <h6><i class="fa fa-shopping-bag" aria-hidden="true"></i> Package & Services</h6>
                    <div class="">
                        <div class="row">
                            <div class="col"><h6>Name</h6></div>
                            <div class="col"><h6>Price (&#8369;)</h6></div>
                            <div class="col"></div>
                        </div>
                        <div class="overall_pricing">
                            @if ($services)
                                @foreach ($services as $row)
                                    <div class="row">
                                        <div class="col">
                                            <p>{{  $row->name }}</p>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="w-75" value="{{$row->max_price}}">
                                            
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input" type="checkbox" value="" id="" checked>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            

                            @if ($package)
                                <div class="row">
                                    <div class="col">
                                        <p>{{  $package->name }}</p></div>
                                    <div class="col">
                                        {{-- <p>&#8369;{{  $package->price}}</p> --}}

                                        <input type="text" class="w-75" value="{{  $package->max_price }}">
                                    </div>
                                    <div class="col">
                                        <input class="form-check-input" type="checkbox" value="" id="" checked>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="pt-2" id="addtional_service">
                            {{-- <div></div> --}}
                        </div>
                        
                        <button type="button" class="btn btn-outline-success mx-auto d-block" data-bs-toggle="modal" data-bs-target="#additionals_modal" id="open_additionals_modal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <h6><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Payment Method <p class="mx-5" style="font-size: 12px">(Cash Basis)</p></h6>
                    <div class="mx-auto w-75">
                        <div class="form-group">
                            <input type="text" class="form-control" id="payment_method" name="payment_method" hidden>

                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" >
                            <label class="btn btn-outline-primary" for="success-outlined">Fully paid</label>
                            <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                            <label class="btn btn-outline-info" for="danger-outlined">Installment</label>

                            <input type="text" class="form-control mt-1" id="total_paid" name="total_paid" value="0" placeholder="Please enter amount paid" hidden>
                            <span class="text-danger error-text total_paid_error"></span>

                            <div class="form-group mt-1">
                                <input type="text" class="form-control w-50" id="promo_code" name="promo_code" placeholder="promo code || for future function" disabled hidden>
                                <span class="text-danger error-text promo_code_error"></span>
                            </div>
                        </div>
                    </div>

                    <h6><i class="fa fa-credit-card" aria-hidden="true"></i> Summary</h6>
                    <div class="mx-auto w-75">
                        <p>Appointmnet receipt {{ $complete_summary->ro_id }} | {{ date("M j, Y", strtotime($complete_summary->app_date ))}} | {{date('h:i A', strtotime($complete_summary->app_time))  }}</p>

                        <div class="row w-75">
                            <div class="col-lg"><h4>Total:</h4></div>
                            <div class="col-lg"><h4>&#8369;<span id="total_price_text" name="total_price_text"></span></h4></div>
                            <input type="text"  id="total_price_input" name="total_price_input" value="" hidden>
                        </div>

                        <div id="for_installment">
                            <div class="row w-75">
                                <div class="col-lg"><h6>Paid:</h6></div>
                                <div class="col-lg"><h6>&#8369;<span id="payment_paid">0</span></h6></div>
                                <input hidden>
                            </div>

                            <div class="row w-75">
                                <div class="col-lg"><h6>Balance:</h6></div>
                                <div class="col-lg"><h6>&#8369;<span id="payment_balance">0</span></h6></div>
                                <input hidden>
                            </div>
                        </div>

                        
                        
                    </div>

                    <div class="row w-50 mx-auto mt-4 mb-3">
                        <button type="submit"class="btn btn-success float-lg-right" id="finish_appointment" disabled>Finish appointment</button>
                    </div>
                </div>

            </div>
        </div>
        <input type="text"  id="customer_id" name="customer_id" value="{{ $complete_summary->customer_id }}" hidden>
        <input type="text"  value="{{ $toshow_equip_id }}" id="equipment_ids_final" name="equipment_ids_final" hidden>
        <input type="text"  value="{{ $toshow_equip_value }}" id="equipment_values_final" name="equipment_values_final" hidden>
        <input type="text"  id="pricing_summary" name="pricing_summary" hidden>
        <input type="text"  value="0" id="balance" name="balance" hidden>

        @include('clinicViews.billing.additionals_modal')
        

    </form>
    @include('clinicViews.billing.loading_modal')
@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/billings/billings.js') }}"></script>
    <script src="{{ URL::asset('js/clinic/billings/billing_computations.js') }}"></script>
@endsection