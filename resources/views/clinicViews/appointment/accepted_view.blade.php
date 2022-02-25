@extends('clinicViews.layouts.master')
@section('title', 'Appointment')
@section('extraStyle')
<link rel="stylesheet" href="{{ URL::asset('css/clinic/appointment/appointment.css') }}">
@endsection
@section('content')

<div class="col-lg-12 overflow-hidden">

    {{-- data came from appointment.js --}}
    {{-- <div class="row gy-2" id="package_body">
        
    </div> --}}

    {{-- @foreach ($data as $rows)
        {{ $rows->ro_package_name }}
    @endforeach --}}

    <div class="row mb-2 d-flex justify-content-end">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#accepted_view_calendar_up" id="calendar_btn">
            <i class="fa fa-calendar mx-2" aria-hidden="true"> View Calendar</i>
        </button>
    </div>

    @if ($data != "")
        <div class="col-lg-12 bg-white rounded" id="appointment_table">
            <table class="table">
                <thead>
                    <tr id="appointment_table_head">
                        <th class="text-center" scope="col"></th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Appointment Date</th>
                        <th class="text-center" scope="col">Time</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody  id="appointment_table_body">
                    {{-- 15 max --comment --}}
                    @foreach ($data as $row)
                    <tr>
                        {{-- <td class="align-middle">{{$row->ro_id}}</td> --}}
                        <td class="align-middle text-center"><img class="rounded-circle" src="{{$row->user_avatar}}" alt="{{$row->user_avatar}}"></td>
                        <td class="align-middle text-center">{{$row->user_email}}</td>
                        <td class="align-middle text-center">{{$row->app_appointed_at}}</td>
                        <td class="align-middle text-center">{{$row->time}}</td>
                        <td class="align-middle text-center">
                            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#accepted_view_detail_modal_up" id="accepted_view_detail_modal" data-id="{{ $row->ro_id }}" title="View Details">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --comment --}}
            {{-- <div class="d-flex justify-content-center" id="pagination_div">
                {{ $next->links() }}
            </div> --}}
            
        </div>
    @else
        <h3>No Available Data To Show</h3>
        <p>by deafault wala pang availble, once may accepted appointment na, lalabas na table</p>
    @endif

    {{-- <div class="row">
        <div class="col-lg-12" id="table_view">table</div>
        <div class="col-lg-12" id="calendar_view">calendar</div>
    </div> --}}

    @include('clinicViews.appointment.accepted_view_detail_modal')
    @include('clinicViews.appointment.accepted_view_calendar')
    
</div>


@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/appointment/appointment.js') }}"></script>
@endsection

   