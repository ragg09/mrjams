@extends('clinicViews.layouts.master')
@section('title', 'Appointment')

@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/appointment/appointment.css') }}">
@endsection

@section('content')

<div class="col-lg-12 overflow-hidden">
    @if ($data != "")
    <div class="row mb-2 bg-white">
        {{-- RESERVE FOR FILTER FUNCTIONS --}}
    </div>

    <div class="col-lg-12 bg-white rounded" id="appointment_table">
        <table class="table">
            <thead>
                <tr id="appointment_table_head">
                    {{-- <th scope="col">Receipt</th> --}}
                    <th class="text-center" scope="col"></th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">Date & Time</th>
                    <th class="text-center" scope="col">Availed Service</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody  id="appointment_table_body">
                {{-- 15 max --}}
                @foreach ($data as $row)
                    <tr>
                    
                        {{-- <td class="align-middle">{{$row->ro_id}}</td> --}}
                        <td class="align-middle text-center"><img class="rounded-circle" src="{{$row->user_avatar}}" alt="{{$row->user_avatar}}"></td>
                        <td class="align-middle text-center">{{$row->user_email}}</td>
                        <td class="align-middle text-center">{{date('M d, Y', strtotime($row->app_appointed_at)) }} {{ date('h:i A', strtotime($row->time))}}</td>
                        <td class="align-middle text-center">{{$row->ro_package_name}} {{ $row->ro_services_name  }}</td>
                        <td class="align-middle text-center">
                            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detail_modal_up" id="detail_modal" data-id="{{ $row->ro_id }}" title="View Details">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        {{-- <div class="d-flex justify-content-center" id="pagination_div">
            {{ $next->links() }}
        </div> --}}
        @include('clinicViews.appointment.detail_modal')
        @include('clinicViews.appointment.accept_modal')
        @include('clinicViews.appointment.decline_modal')

        {{-- view calendar --}}
        @include('clinicViews.appointment.accepted_view_calendar')
    </div>
    @else
        <div class="container" style="height: 80vh">
            <div class="row h-100 justify-content-center align-items-center">
                <img class="rounded" src="{{ URL::asset('images/mrjams/noData.jpg') }}" alt="no data available" style="width: 500px" id="nodata_img">
            </div>
        </div>
    @endif
    
</div>


@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/appointment/appointment.js') }}"></script>
@endsection