@extends('clinicViews.layouts.master')
@section('title', 'Services')
@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/equipments/index.css') }}">
    
@endsection
@section('content')
    <div class="col-lg-12" id="create_div">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_modal">
            <i class="fa fa-plus" aria-hidden="true"></i> Add Service
        </button>

        @if (count($data) > 0)
            <form action="{{ route('clinic.services.create') }}" method="GET" id="search_form">
                <input id="search" type="text" placeholder="Search here . . . ">
            </form>
        @endif
        
    </div>

    @if (count($data) > 0)
        <div class="col-lg-12 bg-white rounded" id="service_table">
            <table class="table">
                <thead>
                    <tr id="services_table_head">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody  id="service_table_body">
                    {{-- 15 max --}}
                    @foreach ($data as $row)
                        <tr>
                            <th scope="row">{{$row->id}}</th>
                            <td>{{$row->name}}</td>
                            <td>&#8369;{{$row->min_price}} - &#8369;{{$row->max_price}}</td>
                            <td>{{$row->description}}</td>
                            <td> 
                                {{-- <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#stats_modal_up" id="stats_modal" data-id="{{$row->id}}" title="Edit {{$row->name}}">
                                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                                </a>    --}}
                                <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_modal_up" id="edit_modal" data-id="{{$row->id}}" title="Edit {{$row->name}}">
                                    <i class="fa fa-pencil" aria-hidden="true" ></i>
                                </a>
                                <a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="{{$row->id}}" title="Delete {{$row->name}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center" id="pagination_div">
                {{ $data->links() }}
            </div>
            
        </div>
    @else
        <div class="container" style="height: 80vh">
            <div class="row h-100 justify-content-center align-items-center">
                <img class="rounded" src="{{ URL::asset('images/mrjams/noData.jpg') }}" alt="no data available" style="width: 500px" id="nodata_img">
            </div>
        </div>
    @endif

    @include('clinicViews.services.stats_modal')
    @include('clinicViews.services.create_modal')
    @include('clinicViews.services.edit_modal')
    @include('clinicViews.services.delete_modal')
@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/services/services.js') }}"></script>
@endsection