@extends('clinicViews.layouts.master')
@section('title', 'Equipments')
@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/equipments/index.css') }}">
@endsection
@section('content')


    <div class="col-lg-12" id="create_div">
        
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_modal">
            <i class="fa fa-plus" aria-hidden="true"></i> Add
        </button>

        @if (count($data) > 0)
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#add_quantity_modal_up" style="margin-right: 5px;">
                <i class="fa fa-plus" aria-hidden="true"></i> Quantity
            </button>
            
            <form action="{{ route('clinic.equipments.create') }}" method="GET" id="search_form">
                <input id="search" type="text" placeholder="Search here . . . ">
            </form>
        @endif

        @if (count($data) > 0)
            <div class="m-3">
                <a href="/clinic/print/{{ date("FY") }}_inventory" class="btn btn-primary" id="" target="_blank" title="Print Inventory">
                    Print <i class="fa fa-print" aria-hidden="true"></i>
                </a>
            </div>
        @endif
        
    </div>

    @if (count($data) > 0)
        <div class="col-lg-12 bg-white rounded" id="equipment_table">
            <table class="table display" id="EquipmentDataTable" >
                <thead>
                    <tr id="equipment_table_head">
                        <th scope="col">Materials <i class="fa fa-sort" aria-hidden="true" style="font-size: 13px;" id="EquipSortIcon" hidden></i></th>
                        <th scope="col">Quantity <i class="fa fa-sort" aria-hidden="true" style="font-size: 13px;" id="EquipSortIcon2" hidden></i></th>
                        <th scope="col">Type</th>
                        <th scope="col">{{-- Action --}}</th> 
                    </tr>
                </thead>
                <tbody  id="equipment_table_body">
                    {{-- 15 max --}}
                    @foreach ($data as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->quantity}} {{$row->unit}}</td>
                            <td>{{$row->type}}</td>
                            <td>    
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

    

    @include('clinicViews.equipments.create_modal')
    @include('clinicViews.equipments.edit_modal')
    @include('clinicViews.equipments.delete_modal')
    @include('clinicViews.equipments.add_quantity_modal')
@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/equipments/equipments.js') }}"></script>
@endsection