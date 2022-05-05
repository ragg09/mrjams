@extends('clinicViews.layouts.master')
@section('title', 'Packages')
@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/packages/index.css') }}">

@endsection
@section('content')

<div id="edit_show_body">
    <div class="row justify-content-center  " id="col_box">
        <div class="col-lg-4 col-md-12 col-sm-12 p-4">
            <div class="" id="top_box">
                @foreach ($package as $row)
                        <h1 class="d-flex justify-content-center">{{ $row->name }}
                            <span id="edit_package_details">
                                <a href="" class="btn" data-bs-toggle="modal" data-bs-target="#edit_package_up" id="edit_package_get_details" data-id="{{$row->id}}" title="Edit {{$row->name}}">
                                    <i class="fa fa-pencil text-primary " aria-hidden="true" ></i></a>
                            </span>
                        </h1>
                        </a>
                        <p>{{ $row->description }}</p>
                        {{-- <p>&#8369;{{$row->min_price}} - &#8369;{{$row->max_price}}</p> --}}
                        <p>Price: &#8369;{{$row->min_price}}</p>
                @endforeach
                
                <img src="https://assets.codepen.io/2301174/icon-karma.svg" alt="" id="box_img">
            </div>
            
        </div>
    </div>
    
    <div class="row justify-content-between mt-lg-0 mt-md-5 mt-sm-5" >
        <div class="col-lg-4 col-md-12 col-sm-12 p-4" id="col_box">
            <div class="" id="mid_box">
                <h3>Equipments 
                    <span id="edit_package_equipments">
                        <a href="" class="btn" data-bs-toggle="modal" data-bs-target="#edit_package_equipment_up" id="edit_package_get_equipments" data-id="{{ $equipment_ids }},{{ $package[0]->id }}">
                            <i class="fa fa-pencil text-primary " aria-hidden="true" ></i></a>
                    </span>
                </h3>
                    
                @foreach ($equipments as $rows)
                    @foreach ($rows as $row)
                        <p class="mx-4">{{ $row->name }}</p>
                    @endforeach
                @endforeach
    
                    {{-- {{ $equipment_ids }}  for edit purposes --}}
                    
                <img src="https://assets.codepen.io/2301174/icon-supervisor.svg" alt="" id="box_img">
            </div>
        </div>
    
        <div class="col-lg-4 col-md-12 col-sm-12 p-4 mt-lg-0 mt-md-5 mt-sm-5" id="col_box">
            <div class="" id="mid_box">
                <h3>Services 
                    <span id="edit_package_details">
                        <a href="" class="btn" data-bs-toggle="modal" data-bs-target="#edit_package_service_up" id="edit_package_get_services" data-id="{{ $service_ids }},{{ $package[0]->id }}">
                            <i class="fa fa-pencil text-primary " aria-hidden="true" ></i></a>
                    </span>
                </h3>
                    
                @foreach ($services as $rows)
                    @foreach ($rows as $row)
                        <p class="mx-4">{{ $row->name }}</p>
                    @endforeach
                @endforeach
    
                    {{-- {{ $service_ids }}  for edit purposes --}}

                    
                <img src="https://assets.codepen.io/2301174/icon-supervisor.svg" alt="" id="box_img">
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center" id="col_box" hidden>
        <div class="col-lg-8 col-md-12 col-sm-12 p-4 mt-md-5 mt-sm-5">
            <div class="" id="bot_box">
                GRPAH
            </div>
        </div>
    </div>
</div>

@include('clinicViews.packages.edit_package_details')
@include('clinicViews.packages.edit_package_equipments')
@include('clinicViews.packages.edit_package_services')

    
@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/packages/packages.js') }}"></script>
@endsection