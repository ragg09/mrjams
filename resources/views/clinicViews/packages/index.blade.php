@extends('clinicViews.layouts.master')
@section('title', 'Packages')
@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/packages/index.css') }}">
@endsection
@section('content')

    <div class="col-lg-12" id="create_div">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_modal">
            <i class="fa fa-plus" aria-hidden="true"></i> Add Package
        </button>
    </div>

    @if (count($data) > 0)
        <div class="col-lg-12 overflow-hidden" id="package_body">
            <div class="row gy-2">
                @foreach ($data as $row)
                    <div class="col-lg-3 p-2 text-center">
                        <div class="rounded p-2 "  id="index_box">
                            <h4>{{$row->name}}</h4>
                            <p>{{$row->description}}</p>
                            {{-- <p>Price: &#8369;{{$row->min_price}} - &#8369;{{$row->max_price}}</p> --}}
                            <p>Price: &#8369;{{$row->min_price}}</p>

                            <div class="row">
                                <div class="col-lg-6 d-flex jusify-content-center">
                                    <a href="/clinic/packages/{{$row->id}}" class="btn btn-outline-primary w-100" title="View {{$row->name}}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center">
                                    <a href="" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#delete_modal" id="delete_modal_up" data-id="{{$row->id}}" title="Delete {{$row->name}}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>  
                @endforeach
                
            </div>
        </div>
    @else
        <div class="container" style="height: 80vh">
            <div class="row h-100 justify-content-center align-items-center">
                <img class="rounded" src="{{ URL::asset('images/mrjams/noData.jpg') }}" alt="no data available" style="width: 500px" id="nodata_img">
            </div>
        </div>
    @endif

    @include('clinicViews.packages.create_modal')
    @include('clinicViews.packages.delete_modal')

@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/packages/packages.js') }}"></script>
@endsection